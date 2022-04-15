<?php



/** --------------------------------------------------------------------------------

 * This controller manages all the business logic for team

 *

 * @package    Grow CRM

 * @author     NextLoop

 *----------------------------------------------------------------------------------*/



namespace App\Http\Controllers;



use App\Http\Controllers\Controller;

use App\Http\Responses\Common\CommonResponse;

use App\Http\Responses\Company\CreateResponse;

use App\Http\Responses\Company\EditResponse;

use App\Http\Responses\Company\IndexResponse;

use App\Http\Responses\Company\StoreResponse;

use App\Repositories\CompanyRepository;

use App\Repositories\AttachmentRepository;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use Illuminate\Validation\Rule;

use Validator;



class Company extends Controller {



    /**

     * The roles repository instance.

     */   
	
    protected $companyrepository;

    protected $attachmentrepo;
	


    public function __construct(CompanyRepository $companyrepository, AttachmentRepository $attachmentrepo) {



        //parent

        parent::__construct();



        //authenticated

        $this->middleware('auth');       


        //dependencies

        $this->companyrepository = $companyrepository;       

               
		
        $this->attachmentrepo = $attachmentrepo;        

    }



    /**

     * Display a listing of team

     * @return \Illuminate\Http\Response

     */

    public function index() {        

        

        $company = $this->companyrepository->search();




        //reponse payload

        $payload = [

            'page' => $this->pageSettings('company'),

            'company' => $company,

        ];


        //show views

        return new IndexResponse($payload);

    }



    /**

     * Show the form for creating a new team member

     * @return \Illuminate\Http\Response

     */

    public function create() {



        //get all team level roles
		
		


        //reponse payload

        $payload = [

            'page' => $this->pageSettings('create'),

            'company' => array(),
			
            'groups' => array(),
			
            'users' => array(),		
            

        ];



        //show the form

        return new CreateResponse($payload);

    }



    /**

     * Store a newly created team member in storage.

     * @return \Illuminate\Http\Response

     */

    public function store() {



        //custom error messages

        $messages = [];



        //validate

        $validator = Validator::make(request()->all(), [

            'company_name' => 'required',

                  

        ], $messages);



        //errors

        if ($validator->fails()) {

            $errors = $validator->errors();

            $messages = '';

            foreach ($errors->all() as $message) {

                $messages .= "<li>$message</li>";

            }
			$jsondata['notification'] = array('type' => 'error', 'value' => $messages);

			return response()->json($jsondata);
            abort(409, $messages);
        }
		
		if (!$companyid = $this->companyrepository->create()) {

            abort(409);

        }
        
		
		if (request('imgupload') !='' && (int)$companyid > 0){			
			
            $filename = $companyid.request('imgupload')->getClientOriginalName();      
            	
			$data_avatar = [

				'directory' => $companyid.'company',

				'filename' => $filename,

			];
			
			$file_path = BASE_DIR . "/storage/temp/". $data_avatar["directory"];			
            
            request('imgupload')->move($file_path, $filename);	
			
			if (!$this->attachmentrepo->processCompanyLogo($data_avatar)) {
				abort(409);
			}
			
			request()->merge(['company_logo' => $data_avatar["directory"].'/'.$data_avatar["filename"]]);
			if (!$this->companyrepository->updateLogo($companyid)) {

				abort(409);

			}
			
		}


        //get the user

        $company = $this->companyrepository->search($companyid);

        $company = $company->first();		

        $payload = [

            'company' => $company,
			
        ];



        //process reponse

        return new StoreResponse($payload);



    }



    /**

     * Show the form for editing the specified team member

     * @param int $id team member id

     * @return \Illuminate\Http\Response

     */

    public function edit($id) {
		
		
        if (!$company = $this->companyrepository->get($id)) {

            abort(409, __('lang.user_not_found'));

        }   
		
		$data['id'] = $id;

        //reponse payload

        $payload = [

            'page' => $this->pageSettings('edit', $data),           

            'company' => $company,
			
            'groups' => array(),

        ];



        //process reponse

        return new EditResponse($payload);



    }



    /**

     * Update profile

     * @param int $id team member id

     * @return \Illuminate\Http\Response

     */

    public function update($id) {



        //custom error messages

        $messages = [

            'role_id.exists' => __('lang.user_role_not_found'),

        ];
		
		
        //validate the form

        $validator = Validator::make(request()->all(), [

            'company_name' => 'required',			

        ], $messages);



        //validation errors

        if ($validator->fails()) {

            $errors = $validator->errors();

            $messages = '';

            foreach ($errors->all() as $message) {

                $messages .= "<li>$message</li>";

            }



            abort(409, $messages);

        }
		
		if (request('imgupload') !=''){			
			
            $filename = $id.request('imgupload')->getClientOriginalName();      
            	
			$data_avatar = [

				'directory' => $id.'company',

				'filename' => $filename,

			];
			
			$file_path = BASE_DIR . "/storage/temp/". $data_avatar["directory"];			
            
            request('imgupload')->move($file_path, $filename);	
			
			if (!$this->attachmentrepo->processCompanyLogo($data_avatar)) {
				abort(409);
			}
			
			request()->merge(['company_logo' => $data_avatar["directory"].'/'.$data_avatar["filename"]]);
			if (!$this->companyrepository->updateLogo($id)) {

				abort(409);

			}
			
		}		
				

        //update the user

        if (!$this->companyrepository->create($id)) {

            abort(409);

        }
		
		$company = $this->companyrepository->search($id);

        $company = $company->first();	

        //reponse payload

        $payload = [

            'company' => $company,
			

        ];



        //generate a response

        return new StoreResponse($payload);

    }



   

    public function destroy($id) {



        //get the item

        if (!$company = $this->companyrepository->search($id)) {

            abort(409);

        }
		
		$fullUrl = request()->fullUrl();
		$_fullUrl = explode('?', $fullUrl);
		$str_source = isset($_fullUrl[1]) ? str_replace('source=','', $_fullUrl[1]) : '';


        //remove the item

        $company->first()->delete();


		$company = $this->groupsrepo->search();
		
		

        $payload = [

            'type' => 'remove-basic',

            'element' => "#comp_$id",

        ];



        //generate a response

        return new CommonResponse($payload);

    }

    

    /**

     * basic page setting for this section of the app

     * @param string $section page section (optional)

     * @param array $data any other data (optional)

     * @return array

     */

    private function pageSettings($section = '', $data = []) {



        //common settings

        $page = [

            'crumbs' => [

                __('lang.company'),

            ],

            'crumbs_special_class' => 'list-pages-crumbs',

            'page' => 'company',

            'no_results_message' => __('lang.no_results_found'),           

            'mainmenu_company' => 'active',

            'sidepanel_id' => 'sidepanel-filter-company',

            'dynamic_search_url' => 'company/search?source=' . request('source') . '&action=search',
			
			'dynamic_search_url_group' => url('company/search'),

            'add_button_classes' => '',

            'load_more_button_route' => 'company',

            'source' => 'list',

        ];



        //default modal settings (modify for sepecif sections)

        $page += [

            'add_modal_title' => __('lang.add_group'),

            'add_modal_create_url' => url('company/create'),

            'add_modal_action_url' => url('company'),

            'add_modal_action_ajax_class' => '',

            'add_modal_action_ajax_loading_target' => '',

            'add_modal_action_method' => 'POST',
			
			'leftpanel' => 'pages.company.form.leftpanel',

        ];



        config([

            //visibility - add project buttton

            'visibility.list_page_actions_add_button' => true,

        ]);



        //contracts list page

        if ($section == 'company') {

            $page += [

                'meta_title' => __('lang.company'),

                'heading' => __('lang.company'),

            ];

            if (request('source') == 'ext') {

                $page += [

                    'list_page_actions_size' => 'col-lg-12',

                ];

            }

            return $page;

        }



        //create new resource

        if ($section == 'create') {

            $page += [
			
				'meta_title' => __('lang.company'),

                'heading' => __('lang.company'),

                'section' => 'create',

                'create_type' => 'company',
				
                'tabmenu_profile' => 'active',
				
                'tabmenu_profile_url' => url('company/create'),
				
				'action_url' => url('company/save'),
				
                'page_content' => 'pages.company.form.content',                

            ];

            return $page;

        }

        //edit new resource

        if ($section == 'edit') {

            $page += [
			
				'meta_title' => __('lang.company'),

                'heading' => __('lang.company'),

                'section' => 'edit',
				
				'tabmenu_profile' => 'active',
				
				'tabmenu_profile_url' => url('company/edit/'.$data['id']),
				
				'action_url' => url('company/update'),
				
                'page_content' => 'pages.company.form.content',
				
				'leftpanel' => 'pages.company.form.leftpanel',

            ];

            return $page;

        }



        //ext page settings

        if ($section == 'ext') {



            $page += [

                'list_page_actions_size' => 'col-lg-12',



            ];



            return $page;

        }



        //return

        return $page;

    }
	
	
	
	

   
	
	

}