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

use App\Http\Responses\Employee\CreateResponse;

use App\Http\Responses\Employee\EditResponse;

use App\Http\Responses\Employee\IndexResponse;

use App\Http\Responses\Employee\StoreResponse;

use App\Http\Responses\Employee\ShowDynamicResponse;

use App\Http\Responses\Employee\StoreResponseDR;

use App\Http\Responses\Employee\StoreResponseMM;

use App\Http\Responses\Employee\StoreResponseReviews;

use App\Repositories\RoleRepository;

use App\Repositories\UserRepository;

use App\Repositories\AttachmentRepository;

use App\Repositories\GroupsRepository;

use App\Repositories\GroupsAssignedRepository;

use App\Repositories\DailyReportRepository;

use App\Repositories\MeetingMinutesRepository;

use App\Repositories\ReviewsRepository;

use App\Repositories\EmployeePaymentRepository;

use App\Repositories\EmailerRepository;

use App\Repositories\EventRepository;

use App\Repositories\EventTrackingRepository;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;

use Illuminate\Validation\Rule;

use Validator;

use Log;

class Employee extends Controller {



    /**

     * The roles repository instance.

     */

    protected $roles;



    /**

     * The users repository instance.

     */

    protected $userrepo;
	
	
    protected $attachmentrepo;
	
	
	protected $groupsrepo;
	
	protected $groupsassignedrepository;
	
	protected $dailyreportrepository;
	
	protected $meetingminutesrepository;
	
	protected $reviewrepository;

    protected $paymentrepository;


    public function __construct(RoleRepository $roles, UserRepository $userrepo, AttachmentRepository $attachmentrepo, GroupsRepository $groupsrepo, GroupsAssignedRepository $groupsassignedrepository, DailyReportRepository $dailyreportrepository, EmployeePaymentRepository $paymentrepository, EventRepository $eventrepo, EventTrackingRepository $trackingrepo, EmailerRepository $emailerrepo, MeetingMinutesRepository $meetingminutesrepository, ReviewsRepository $reviewrepository) {



        //parent

        parent::__construct();



        //authenticated

        $this->middleware('auth');

       


        //dependencies

        $this->roles = $roles;

        $this->userrepo = $userrepo;
		
        $this->userrepo = $userrepo;
		
        $this->attachmentrepo = $attachmentrepo;
		
		$this->groupsrepo = $groupsrepo;
		
		$this->groupsassignedrepository = $groupsassignedrepository;
		
		$this->dailyreportrepository = $dailyreportrepository;
		
		$this->meetingminutesrepository = $meetingminutesrepository;
		
		$this->reviewrepository = $reviewrepository;

        $this->paymentrepository = $paymentrepository;

        $this->eventrepo = $eventrepo;

        $this->trackingrepo = $trackingrepo;

        $this->emailerrepo = $emailerrepo;

    }



    /**

     * Display a listing of team

     * @return \Illuminate\Http\Response

     */

    public function index() {



        

        request()->merge([

            'type' => 'employee',

            'status' => 'active',

        ]);

        $users = $this->userrepo->search();




        //reponse payload

        $payload = [

            'page' => $this->pageSettings('employee'),

            'users' => $users,

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
		
		$groups = $this->groupsrepo->search();

        $roles = $this->roles->allTeamRoles();
		
		

        //reponse payload
		$list_employee = $this->groupsassignedrepository->search_employee();
		$employees=[];
		if(count($list_employee) > 0){
			
			foreach($list_employee as $le){
				$employees[$le->groupassigned_groupid][] = array(
					'groupassigned_userid'	=> $le->groupassigned_userid,
					'first_name'			=> $le->first_name,
					'groupassigned_id'		=> $le->groupassigned_id,
				);
			}
			
		}
		
		
		$daily_reports=[];
		$reviews=[];
		$daily_reports = $this->dailyreportrepository->search();
		$meeting_minutes = $this->meetingminutesrepository->search();
		$reviews = $this->reviewrepository->search();
        $employee_payments = [];
		
		request()->merge([

            'type' => 'employee',

            'status_employee' => 'inactive',

        ]);

        $emp_inactive = $this->userrepo->search();


        //reponse payload

        $payload = [

            'page' => $this->pageSettings('create'),

            'roles' => $roles,
			
            'groups' => $groups,
			
            'users' => array(),
			
            'list_employee' => $employees,
			
			'list_employee_inactive' => $emp_inactive,
			
            'daily_reports' => $daily_reports,
			
			'meeting_minutes' => $meeting_minutes,
			
			'reviews' => $reviews,

            'employee_payments' => $employee_payments,

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

            'full_name' => 'required',

            'employee_name' => 'required',

            'email' => 'required|email|unique:users,email',
			
            'company_email' => 'email',            

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



        //set other data

        request()->merge(['type' => 'employee', 'first_name' => request('full_name'),'role_id'=>13]);
		

        //save

        $password = '';
		
		if (request('password') != '') {

            $password = bcrypt(request('password'));

        }		

        if (!$userid = $this->userrepo->create($password)) {

            abort(409);

        }
		
		if (request('imgupload') !='' && (int)$userid > 0){			
			
            $filename = $userid.request('imgupload')->getClientOriginalName();      
            	
			$data_avatar = [

				'directory' => $userid.'employee',

				'filename' => $filename,

			];
			
			$file_path = BASE_DIR . "/storage/temp/". $data_avatar["directory"];			
            
            request('imgupload')->move($file_path, $filename);	
			
			if (!$this->attachmentrepo->processAvatar($data_avatar)) {
				abort(409);
			}
			
			request()->merge(['avatar_directory' => $data_avatar["directory"],'avatar_filename' => $data_avatar["filename"]]);
			if (!$this->userrepo->updateAvatar($userid)) {

				abort(409);

			}
			
		}


        //get the user

        $users = $this->userrepo->search($userid);

        $user = $users->first();



        //update team user specific - default notification settings (defaults are set in config/settings.php)

        $user->notifications_projects_activity = 'yes_email';

        $user->notifications_billing_activity = 'yes_email';

        $user->notifications_new_assignement = 'yes_email';

        $user->notifications_leads_activity = 'yes_email';

        $user->notifications_tasks_activity = 'yes_email';

        $user->notifications_tickets_activity = 'yes_email';

        $user->notifications_system = 'yes_email';

        $user->force_password_change = config('settings.force_password_change');

        $user->save();



        /** ----------------------------------------------

         * send email [comment

         * ----------------------------------------------*/

        //send to users

        $data = [

            'password' => $password,

        ];

        // $mail = new \App\Mail\UserWelcome($user, $data);

        // $mail->build();


		request()->merge([

            'type' => 'employee',

            'status_employee' => 'inactive',

        ]);

        $emp_inactive = $this->userrepo->search();

        //reponse payload

        $payload = [

            'users' => $users,
			
            'list_employee_inactive' => $emp_inactive,

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


		$groups = $this->groupsrepo->search();
		
        //get all team level roles

        $roles = $this->roles->allTeamRoles();



        //get the user

        if (!$user = $this->userrepo->get($id)) {

            abort(409, __('lang.user_not_found'));

        }

		$data['id'] = $id;

       $emp_inactive = $this->userrepo->search();

        //reponse payload

        $payload = [

            'page' => $this->pageSettings('edit', $data),

            'list_employee_inactive' => $emp_inactive,

            'users' => $user,
            'groups' => $groups,

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

            'full_name' => 'required',

			'employee_name' => 'required',

            'email' => [

                'required',

                Rule::unique('users', 'email')->ignore($id, 'id'),

            ],           
		
			'company_email' => 'email',

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

				'directory' => $id.'employee',

				'filename' => $filename,

			];
			
			$file_path = BASE_DIR . "/storage/temp/". $data_avatar["directory"];			
            
            request('imgupload')->move($file_path, $filename);	
			
			if (!$this->attachmentrepo->processAvatar($data_avatar)) {
				abort(409);
			}
			
			request()->merge(['avatar_directory' => $data_avatar["directory"],'avatar_filename' => $data_avatar["filename"]]);
			if (!$this->userrepo->updateAvatar($id)) {

				abort(409);

			}
			
		}

		request()->merge(['first_name' => request('full_name')]);

        //update the user

        if (!$this->userrepo->update($id)) {

            abort(409);

        }
		
        //get user

        request()->merge([

            'type' => 'employee',

            'status_employee' => 'inactive',			

        ]);

		$emp_inactive = $this->userrepo->search();
		
		$users = $this->userrepo->get($id);

        //reponse payload

        $payload = [

            'users' => $users,
			
			'list_employee_inactive' => $emp_inactive,

        ];



        //generate a response

        return new StoreResponse($payload);

    }



    /**

     * Update preferences of logged in user

     * @return null silent

     */

    public function updatePreferences() {



        $this->userrepo->updatePreferences(auth()->id());



    }



    /**

     * Remove the specified team member from storage.

     * @param int $id team member id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id) {



        //user validation

        if (!$user = \App\Models\User::Where('id', $id)->first()) {

            abort(409, __('lang.user_not_found'));

        }



        //delete project assignments

        \App\Models\ProjectAssigned::Where('projectsassigned_userid', $id)->delete();



        //delete task assignments

        \App\Models\TaskAssigned::Where('tasksassigned_userid', $id)->delete();



        //delete lead assignments

        \App\Models\LeadAssigned::Where('leadsassigned_userid', $id)->delete();



        //delete project manager

        \App\Models\ProjectManager::Where('projectsmanager_userid', $id)->delete();



        //make account as deleted

        $user->status = 'deleted';



        //delete email

        $user->email = '';



        //delete password

        $user->password = '';



        //remove avater

        $user->avatar_filename = '';



        //update delete date

        $user->deleted = now();



        //save user

        $user->save();



        //reponse payload

        $payload = [

            'type' => 'remove-basic',

            'element' => "#team_$id",

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

                __('lang.employee'),

            ],

            'crumbs_special_class' => 'list-pages-crumbs',

            'page' => 'employee',

            'no_results_message' => __('lang.no_results_found'),           

            'mainmenu_employee' => 'active',

            'sidepanel_id' => 'sidepanel-filter-employee',

            'dynamic_search_url' => 'employee/search?source=' . request('source') . '&action=search',
			
			'dynamic_search_url_group' => url('groups/search'),

            'add_button_classes' => '',

            'load_more_button_route' => 'employee',

            'source' => 'list',

        ];



        //default modal settings (modify for sepecif sections)

        $page += [

            'add_modal_title' => __('lang.add_group'),

            'add_modal_create_url' => url('employee/create'),

            'add_modal_action_url' => url('employee'),

            'add_modal_action_ajax_class' => '',

            'add_modal_action_ajax_loading_target' => '',

            'add_modal_action_method' => 'POST',
			
			'leftpanel' => 'pages.employee.form.leftpanel',

        ];



        config([

            //visibility - add project buttton

            'visibility.list_page_actions_add_button' => true,

        ]);



        //contracts list page

        if ($section == 'employee') {

            $page += [

                'meta_title' => __('lang.employee'),

                'heading' => __('lang.employee'),

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
			
				'meta_title' => __('lang.employee'),

                'heading' => __('lang.employee'),

                'section' => 'create',

                'create_type' => 'employee',
				
                'tabmenu_profile' => 'active',
				
                'tabmenu_profile_url' => url('employee/create'),
				
				'action_url' => url('employee/save_employee'),
				
                'page_content' => 'pages.employee.form.content',                

            ];

            return $page;

        }
		
		if ($section == 'daily_report' || $section == 'dr') {

            $page += [
			
				'meta_title' => __('lang.employee'),

                'heading' => __('lang.employee'),

                'section' => 'create',

                'create_type' => 'employee',
				
                'tabmenu_daily_report' => 'active',
				
                'tabmenu_profile_url' => url('employee/create'),
				
				'action_url' => url('employee/save_dr'),    

				'page_content' => 'pages.employee.form.dr', 
			
            ];

            return $page;

        }

        if ($section == 'payment' || $section == 'payment_content'  ) {

            $page += [
			
				'meta_title' => __('lang.employee'),

                'heading' => __('lang.employee'),

                'section' => 'payment',

                // 'create_type' => 'employee',
				
                'tabmenu_payment' => 'active',
				
                'tabmenu_profile_url' => url('employee/create'),
				
				'action_url' => url('employee/save_dr'),    

				'page_content' => 'pages.employee.form.payment', 

                
			
            ];

            return $page;

        }
		
		if ($section == 'meeting_minutes' || $section == 'meeting_m') {

            $page += [
			
				'meta_title' => __('lang.employee'),

                'heading' => __('lang.employee'),

                'section' => 'meeting_minutes',

                'create_type' => 'employee',
				
                'tabmenu_meeting_minutes' => 'active',
				
                'tabmenu_profile_url' => url('employee/create'),
				
				'action_url' => url('employee/save_meeting_minutes'),    

				'page_content' => 'pages.employee.form.meeting-minutes', 
			
            ];

            return $page;

        }
		
		if ($section == 'employee-files') {

            $page += [
			
				'add_modal_create_url' => url('files/create?fileresource_id=' . auth()->id() . '&fileresource_type=employee'),

				'add_modal_action_url' => url('files?fileresource_id=' . auth()->id() . '&fileresource_type=employee'),
			
				'tabmenu_files' => 'active',
			
				'list_page_actions_size' => 'col-lg-12',
			
				'meta_title' => __('lang.employee'),

                'heading' => __('lang.employee'),

                'section' => 'files',

                'create_type' => 'employee',		               
				
                'tabmenu_profile_url' => url('employee/create'),				   

				'page_content' => 'pages.employee.files.tabswrapper', 
			
            ];

            return $page;

        }
		
		if ($section == 'review' || $section == 'review_content') {

            $page += [
			
				'meta_title' => __('lang.employee'),

                'heading' => __('lang.employee'),

                'section' => 'review',

                'create_type' => 'employee',
				
                'tabmenu_review' => 'active',
				
                'tabmenu_profile_url' => url('employee/create'),
				
				'action_url' => url('employee/save_review'),    

				'page_content' => 'pages.employee.form.reviews', 
			
            ];

            return $page;

        }



        //edit new resource

        if ($section == 'edit') {

            $page += [
			
				'meta_title' => __('lang.employee'),

                'heading' => __('lang.employee'),

                'section' => 'edit',
				
				'tabmenu_profile' => 'active',
				
				'tabmenu_profile_url' => url('employee/edit/'.$data['id']),
				
				'action_url' => url('employee/update'),
				
                'page_content' => 'pages.employee.form.content',
				
				'leftpanel' => 'pages.employee.form.leftpanel',

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
	
	
	
	public function showDynamic($id=0) {

        //reponse payload
		
		$sections = request()->segment(2);
        $id = request('id') ?? 0 ;

		$page = $this->pageSettings($sections);        
		$dynamic = 0;
		$employees=[];
		$emp_inactive=[];
		$groups=[];
		$reviews=[];
		
		$meeting_minutes=[];
        // request('employee_id', 12);
        
		$groups=[];
        $users = [];
        if($id > 0){
            if (!$users = $this->userrepo->get($id)) {

                abort(409, __('lang.user_not_found '.$id));
    
            }
            request()->merge([

                'employee_id' => $users->employee_id,
    
            ]);
        }
 
		$daily_reports=[];
		$daily_reports = $this->dailyreportrepository->search();
		$meeting_minutes = $this->meetingminutesrepository->search();
		$reviews = $this->reviewrepository->search();
        $employee_payments = [];        
		switch ($sections) {
            case 'payment':
                $dynamic = 0;
                $user_id = $id > 0 ? "?id=".$id : "";
                $page['dynamic_url'] = url('employee/payment_content').$user_id; 
                $employee_payments = $this->paymentrepository->search();
                break;
            case 'payment_content':
                $dynamic = 1;
                $page['dynamic_url'] = url('employee/payment_content'); 
                $employee_payments = $this->paymentrepository->search();
				break;
			case 'dr':	
				$dynamic = 1;				
				$page['dynamic_url'] = url('employee/dr'); 
				break;
			case 'meeting_m':	
				$dynamic = 1;				
				$page['dynamic_url'] = url('employee/meeting_m');
				break;
			case 'meeting_minutes':
                $dynamic = 0;
                $page['dynamic_url'] = url('employee/meeting_m'); 
                break;
			case 'review':	
				$dynamic = 0;				
				$page['dynamic_url'] = url('employee/review');
				break;
			case 'review_content':
                $dynamic = 1;
                $page['dynamic_url'] = url('employee/review'); 
                break;
			case 'employee-files':
                $dynamic = 0;
                $page['dynamic_url'] = url('employee/files?source=ext&page=1&fileresource_type=employee'); 
                break;
			default:					
				$page['dynamic_url'] = url('employee/dr');         

            break;
		}
		
		if((int)$dynamic == 0){
			$groups = $this->groupsrepo->search();
				
				//reponse payload
				$list_employee = $this->groupsassignedrepository->search_employee();
				
				request()->merge([

					'type' => 'employee',

					'status_employee' => 'inactive',

				]);

				$emp_inactive = $this->userrepo->search();
				
				if(count($list_employee) > 0){					
					foreach($list_employee as $le){
						$employees[$le->groupassigned_groupid][] = array(
							'groupassigned_userid'	=> $le->groupassigned_userid,
							'first_name'			=> $le->first_name,
							'groupassigned_id'		=> $le->groupassigned_id,
						);
					}
					
				}				
		}
		
		

		$payload = [

            'page' => $page,        
            
            'section' => $sections,
			
            'users' => $users,		
			
            'groups' => $groups,
			
			'list_employee_inactive' => $emp_inactive,
			
            'list_employee' => $employees,
			
            'daily_reports' => $daily_reports,
			
			'meeting_minutes' => $meeting_minutes,
			
			'reviews' => $reviews,

            'employee_payments' => $employee_payments 

        ];

        //show the form
		if($dynamic > 0) return new ShowDynamicResponse($payload);		
        return new CreateResponse($payload);
        

    }

   
	public function store_dr() {


        //custom error messages

        $messages = [

            'your_day_general.required' => 'How was your day in General required',

        ];



        //validate

        $validator = Validator::make(request()->all(), [

            'your_day_general' => 'required',   

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

        //save    
		
		$id = (int)request('dailyreport_id');
		
        if (!$dailyreport_id = $this->dailyreportrepository->create($id)) {

            abort(409);

        }
		
		

		$page = $this->pageSettings('dr');        
		$dynamic = 0;
		$employees=[];
		$groups=[];
		$daily_reports=[];
		$daily_reports = $this->dailyreportrepository->search();
        $page['dynamic_url'] = url('employee/dr');


        //reponse payload
		$payload = [

            'page' => $page,            
			
            'users' => array(),		
			
            'groups' => $groups,
			
            'users' => array(),
			
            'list_employee' => $employees,
			
            'daily_reports' => $daily_reports,	
			

        ];

        //process reponse

         return new StoreResponseDR($payload);
    }
	
	public function store_mm() {



        //custom error messages

        $messages = [

            'meetingminutes_title.required' => 'Title required',

        ];



        //validate

        $validator = Validator::make(request()->all(), [

            'meetingminutes_title' => 'required',   

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

        //save    
		
		$id = (int)request('meetingminutes_id');
		
        if (!$meetingminutes_id = $this->meetingminutesrepository->create($id)) {

            abort(409);

        }		

		$page = $this->pageSettings('meeting_m');        
		$dynamic = 0;
		$employees=[];
		$groups=[];
		$meeting_minutes=[];
		$meeting_minutes = $this->meetingminutesrepository->search();
        $page['dynamic_url'] = url('employee/meeting_m');


        //reponse payload
		$payload = [

            'page' => $page,            
			
            'users' => array(),		
			
            'groups' => $groups,
			
            'users' => array(),
			
            'list_employee' => $employees,           
			
            'meeting_minutes' => $meeting_minutes,

        ];

        //process reponse

         return new StoreResponseMM($payload);

    }
	
	public function store_review() {



        //custom error messages

        $messages = [

            'review_title.required' => 'Title required',

        ];



        //validate

        $validator = Validator::make(request()->all(), [

            'review_title' => 'required',   

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

        //save    
		
		$id = (int)request('reviewemployee_id');
		
        if (!$reviewemployee_id = $this->reviewrepository->create($id)) {

            abort(409);

        }		

		$page = $this->pageSettings('review_content');        
		$dynamic = 0;
		$employees=[];
		$groups=[];
		$reviews=[];
		$reviews = $this->reviewrepository->search();
        $page['dynamic_url'] = url('employee/review_content');


        //reponse payload
		$payload = [

            'page' => $page,            
			
            'users' => array(),		
			
            'groups' => $groups,
			
            'users' => array(),
			
            'list_employee' => $employees,           
			
            'reviews' => $reviews,

        ];

        //process reponse

         return new StoreResponseReviews($payload);

    }
	

    public function store_payment(){

        $validator = Validator::make(request()->all(), [
            'employee_id'=>'required',
            'paid_date' => 'required',   
            'payment_title' => 'required',
            'payment_title' => 'required',
            'paid_amount' => 'required|integer|min:0'

        ]);

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
        
        if(request('employee_id') > 0){
            if (!$users = $this->userrepo->getByEmployeeId((int)request('employee_id'))) {

                $jsondata['notification'] = array('type' => 'error', 'value' => "Employee not found".request('employee_id'));

                return response()->json($jsondata);
                abort(409, __('lang.user_not_found '));
    
            }
        }

        if (!$payment_id = $this->paymentrepository->create()) {

            abort(409);

        }

        $curr_payments = $this->paymentrepository->search($payment_id);

        $curr_payment = $curr_payments->first();

        $data = [

            'event_creatorid' => auth()->id(),

            'event_item' => 'payment',

            'event_item_id' => $payment_id,

            'event_item_lang' => 'event_posted_a_comment',

            'event_item_content' => $curr_payment->payment_title,

            'event_item_content2' => '',

            'event_clientid' => 0,

            'event_parent_type' => 'employee',

            'event_parent_id' => '',

            'event_parent_title' => '',

            'event_show_item' => 'yes',

            'event_show_in_timeline' => 'no',

            'event_notification_category' => 'notifications_tasks_activity',

            'eventresource_type' => '',

            'eventresource_id' => '',

        ];

        //record event

        if ($event_id = $this->eventrepo->create($data)) {

            //record notification

            $emailusers = $this->trackingrepo->recordEvent($data, $users, $event_id);

        }



        $page = $this->pageSettings('payment');        
		$dynamic = 0;
		$employees=[];
		$groups=[];
		$daily_reports=[];
        $employee_payments = [];
        $employee_payments = $this->paymentrepository->search();
        $user_id = $users->id > 0 ? "?id=".$users->id : "";
        $page['dynamic_url'] = url('employee/payment_content').$user_id; 

        


        //reponse payload
		$payload = [

            'page' => $page,            
			
            'users' => array(),		
			
            'groups' => $groups,
			
            'users' => $users,
			
            'list_employee' => $employees,

            'employee_payments' => $employee_payments,
			
            'section' => 'payment_content',

            'notification' => true
            

        ];

        //process reponse

         return new ShowDynamicResponse($payload);

    }

}