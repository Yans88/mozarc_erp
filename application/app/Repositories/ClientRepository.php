<?php



/** --------------------------------------------------------------------------------

 * This repository class manages all the data absctration for clients

 *

 * @package    Grow CRM

 * @author     NextLoop

 *----------------------------------------------------------------------------------*/



namespace App\Repositories;



use App\Models\Client;

//use App\Repositories\TagRepository;

use App\Repositories\UserRepository;

use DB;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;

use Log;



class ClientRepository {



    /**

     * The clients repository instance.

     */

    protected $clients;



    /**

     * The tag repository instance.

     */

    protected $tagrepo;



    /**

     * The user repository instance.

     */

    protected $userrepo;



    /**

     * Inject dependecies

     */

    public function __construct(Client $clients, TagRepository $tagrepo, UserRepository $userrepo) {

        $this->clients = $clients;

        $this->tagrepo = $tagrepo;

        $this->userrepo = $userrepo;



    }



    /**

     * Search model

     * @param int $id optional for getting a single, specified record

     * @return object clients collection

     */

    public function search($id = '') {



        $clients = $this->clients->newQuery();



        // all client fields

        $clients->selectRaw('*');



        //count: clients projects by status

        foreach (config('settings.project_statuses') as $key => $value) {

            $clients->countProjects($key);

        }

        $clients->countProjects('all');

        $clients->countProjects('pending');



        //count: clients invoices by status

        foreach (config('settings.invoice_statuses') as $key => $value) {

            $clients->countInvoices($key);

        }

        $clients->countInvoices('all');



        //sum: clients invoices by status

        foreach (config('settings.invoice_statuses') as $key => $value) {

            $clients->sumInvoices($key);

        }

        $clients->sumInvoices('all');



        //sum payments

        $clients->selectRaw("(SELECT SUM(payment_amount)

                                     FROM payments

                                     WHERE payments.payment_clientid = clients.client_id

                                     ) AS sum_all_payments");



        //join: primary contact

        $clients->leftJoin('users', function ($join) {

            $join->on('users.clientid', '=', 'clients.client_id');

            $join->on('users.account_owner', '=', DB::raw("'yes'"));

        });



        //join: client category

        $clients->leftJoin('categories', 'categories.category_id', '=', 'clients.client_categoryid');



        //default where

        $clients->whereRaw("1 = 1");



        //ignore system client

        $clients->where('client_id', '>', 0);



        //filters: id

        if (request()->filled('filter_client_id')) {

            $clients->where('client_id', request('filter_client_id'));

        }

        if (is_numeric($id)) {

            $clients->where('client_id', $id);

        }



        //filter: status

        if (request()->filled('filter_client_status')) {

            $clients->where('client_status', request('filter_client_status'));

        }



        //filter: created date (start)

        if (request()->filled('filter_date_created_start')) {

            $clients->where('client_created', '>=', request('filter_date_created_start'));

        }



        //filter: created date (end)

        if (request()->filled('filter_date_created_end')) {

            $clients->where('client_created', '<=', request('filter_date_created_end'));

        }



        //filter: contacts

        if (is_array(request('filter_client_contacts')) && !empty(array_filter(request('filter_client_contacts'))) && !empty(array_filter(request('filter_client_contacts')))) {

            $clients->whereHas('users', function ($query) {

                $query->whereIn('id', request('filter_client_contacts'));

            });

        }



        //filter: catagories

        if (is_array(request('filter_client_categoryid')) && !empty(array_filter(request('filter_client_categoryid'))) && !empty(array_filter(request('filter_client_categoryid')))) {

            $clients->whereHas('category', function ($query) {

                $query->whereIn('category_id', request('filter_client_categoryid'));

            });

        }



        //filter: tags

        if (is_array(request('filter_tags')) && !empty(array_filter(request('filter_tags'))) && !empty(array_filter(request('filter_tags')))) {

            $clients->whereHas('tags', function ($query) {

                $query->whereIn('tag_title', request('filter_tags'));

            });

        }



        //search: various client columns and relationships (where first, then wherehas)

        if (request()->filled('search_query')) {

            $clients->where(function ($query) {

                $query->Where('client_id', '=', request('search_query'));

                $query->orwhere('client_company_name', 'LIKE', '%' . request('search_query') . '%');

                $query->orWhere('client_created', 'LIKE', '%' . request('search_query') . '%');

                $query->orWhere('client_status', '=', request('search_query'));

                $query->orWhereHas('tags', function ($query) {

                    $query->where('tag_title', 'LIKE', '%' . request('search_query') . '%');

                });

                $query->orWhereHas('category', function ($query) {

                    $query->where('category_name', 'LIKE', '%' . request('search_query') . '%');

                });

            });



        }



        //sorting

        if (in_array(request('sortorder'), array('desc', 'asc')) && request('orderby') != '') {

            //direct column name

            if (Schema::hasColumn('clients', request('orderby'))) {

                $clients->orderBy(request('orderby'), request('sortorder'));

            }

            //others

            switch (request('orderby')) {

            case 'contact':

                $clients->orderBy('first_name', request('sortorder'));

                break;

            case 'count_projects':

                $clients->orderBy('count_projects_all', request('sortorder'));

                break;

            case 'sum_invoices':

                $clients->orderBy('sum_invoices_all', request('sortorder'));

                break;

            case 'category':

                $clients->orderBy('category_name', request('sortorder'));

                break;

            }

        } else {

            //default sorting

            $clients->orderBy('client_company_name', 'asc');

        }



        //eager load

        $clients->with([

            'tags',

            'users',

        ]);



        // Get the results and return them.

        return $clients->paginate(config('system.settings_system_pagination_limits'));

    }



    /**

     * Create a new client record [API]

     * @return mixed object|bool  object or process outcome

     */

    public function create($data = []) {



        //save new user

        $client = new $this->clients;



        /** ----------------------------------------------

         * create the client

         * ----------------------------------------------*/

        $client->client_creatorid = Auth()->user()->id;

        $client->client_company_name = request('client_company_name');

        $client->client_phone = request('client_phone');

        $client->client_website = request('client_website');

        $client->client_vat = request('client_vat');

        $client->client_billing_street = request('client_billing_street');

        $client->client_billing_city = request('client_billing_city');

        $client->client_billing_state = request('client_billing_state');

        $client->client_billing_zip = request('client_billing_zip');

        $client->client_billing_country = request('client_billing_country');

        $client->client_categoryid = (request()->filled('client_categoryid')) ? (count(request('client_categoryid')) > 1 ? implode(",", request('client_categoryid')) : request('client_categoryid')[0] ) : 2; //default
		
		$client->client_description = request('client_wiki');



        /** ----------------------------------------------

         * apply custom fields

         * ----------------------------------------------*/

        $this->applyCustomFields($client);



        //save

        if (!$client->save()) {

            Log::error("record could not be saved - database error", ['process' => '[ClientRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            return false;

        }



        /** ----------------------------------------------

         * add client tags

         * ----------------------------------------------*/

        $this->tagrepo->add('client', $client->client_id);



        /** ----------------------------------------------

         * create the default user

         * ----------------------------------------------*/

        request()->merge([

            'account_owner' => 'yes',

            'role_id' => 2,

            'type' => 'client',

            'clientid' => $client->client_id,

        ]);

        $password = str_random(7);

        if (!$user = $this->userrepo->create(bcrypt($password), 'user')) {

            Log::error("default client user could not be added - database error", ['process' => '[ClientRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            abort(409);

        }



        /** ----------------------------------------------

         * send welcome email

         * ----------------------------------------------*/

        if ($data['send_email'] == 'yes') {

            $emaildata = [

                'password' => $password,

            ];

            $mail = new \App\Mail\UserWelcome($user, $emaildata);

            $mail->build();

        }



        //return client id

        if ($data['return'] == 'id') {

            return $client->client_id;

        } else {

            return $client;

        }

    }



    /**

     * Create a new client

     * @return mixed object|bool client object or failed

     */

    public function signUp() {



        //save new user

        $client = new $this->clients;



        //data

        $client->client_company_name = request('client_company_name');

        $client->client_creatorid = 0;



        //save and return id

        if ($client->save()) {

            return $client;

        } else {

            Log::error("record could not be saved - database error", ['process' => '[ClientRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            return false;

        }

    }



    /**

     * update a record

     * @param int $id client id

     * @return mixed int|bool client id or failed

     */

    public function update($id) {



        //get the record

        if (!$client = $this->clients->find($id)) {

            Log::error("client record could not be found", ['process' => '[ClientRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__, 'client_id' => $id ?? '']);

            return false;

        }



        //general

        $client->client_company_name = request('client_company_name');

        $client->client_phone = request('client_phone');

        $client->client_website = request('client_website');

        $client->client_vat = request('client_vat');



        //billing address

        $client->client_billing_street = request('client_billing_street');

        $client->client_billing_city = request('client_billing_city');

        $client->client_billing_state = request('client_billing_state');

        $client->client_billing_zip = request('client_billing_zip');

        $client->client_billing_country = request('client_billing_country');

        $client->client_categoryid = (request()->filled('client_categoryid')) ? (count(request('client_categoryid')) > 1 ? implode(",", request('client_categoryid')) : request('client_categoryid')[0] ) : 2; //default



        //shipping address

        if (config('system.settings_clients_shipping_address') == 'enabled') {

            $client->client_shipping_street = request('client_shipping_street');

            $client->client_shipping_city = request('client_shipping_city');

            $client->client_shipping_state = request('client_shipping_state');

            $client->client_shipping_zip = request('client_shipping_zip');

            $client->client_shipping_country = request('client_shipping_country');

        }



        //status

        if (auth()->user()->is_team) {

            $client->client_status = request('client_status');

        }



        //apply custom fields data

        $this->applyCustomFields($client);



        //save

        if ($client->save()) {

            return $client->client_id;

        } else {

            Log::error("record could not be updated - database error", ['process' => '[ClientRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            return false;

        }

    }



    /**

     * various feeds for ajax auto complete

     * @param string $type (company_name)

     * @param string $searchterm

     * @return object client model object

     */

    public function autocompleteFeed($type = '', $searchterm = '', $limit='') {



        //validation

        if ($type == '' || $searchterm == '') {

            return [];

        }



        //start
		
		// $user = $this->userrepo->newQuery()->where('id', [auth()->user()->id])->take(1)->get();
		//$user = $this->userrepo->exists((int)[auth()->user()->id]);
		
		//Log::error($user);

        $query = $this->clients->newQuery();



        //ignore system client

        $query->where('client_id', '>', 0);



        //feed: company names

        if ($type == 'company_name') {

            $query->selectRaw('client_company_name AS value, client_id AS id');

            $query->where('client_company_name', 'LIKE', '%' . $searchterm . '%');

        }
		Log::error(auth()->user()->role->role_id);

		if ($limit == 'assigned') {			
			// $query->leftJoin('users', function ($join) {
				// $join->on('users.id', '=', 'client_creatorid ');
			// });
			// $query->where('users.account_owner', '=', DB::raw("'yes'"));
			$query->where('client_creatorid', '=', [auth()->user()->id]);

        }

        //return

        return $query->get();

    }



    /**

     * update a record

     * @param int $id record id

     * @return bool process outcome

     */

    public function updateLogo($id) {



        //get the user

        if (!$client = $this->clients->find($id)) {

            return false;

        }



        //update logo

        $client->client_logo_folder = request('logo_directory');

        $client->client_logo_filename = request('logo_filename');



        //save

        if ($client->save()) {

            return true;

        } else {

            Log::error("record could not be updated - database error", ['process' => '[ClientRepository]', config('app.debug_ref'), 'function' => __function__, 'file' => basename(__FILE__), 'line' => __line__, 'path' => __file__]);

            return false;

        }

    }



    /**

     * update model wit custom fields data (where enabled)

     */

    public function applyCustomFields($client) {



        //custom fields

        $fields = \App\Models\CustomField::Where('customfields_type', 'clients')->get();

        foreach ($fields as $field) {

            if ($field->customfields_status == 'enabled') {

                switch ($field->customfields_name) {

                case 'client_custom_field_1':

                    $client->client_custom_field_1 = request('client_custom_field_1');

                    break;

                case 'client_custom_field_2':

                    $client->client_custom_field_2 = request('client_custom_field_2');

                    break;

                case 'client_custom_field_3':

                    $client->client_custom_field_3 = request('client_custom_field_3');

                    break;

                case 'client_custom_field_4':

                    $client->client_custom_field_4 = request('client_custom_field_4');

                    break;

                case 'client_custom_field_5':

                    $client->client_custom_field_5 = request('client_custom_field_5');

                    break;

                case 'client_custom_field_6':

                    $client->client_custom_field_6 = request('client_custom_field_6');

                    break;

                case 'client_custom_field_7':

                    $client->client_custom_field_7 = request('client_custom_field_7');

                    break;

                case 'client_custom_field_8':

                    $client->client_custom_field_8 = request('client_custom_field_8');

                    break;

                case 'client_custom_field_9':

                    $client->client_custom_field_9 = request('client_custom_field_9');

                    break;

                case 'client_custom_field_10':

                    $client->client_custom_field_10 = request('client_custom_field_10');

                    break;

                }

            }

        }

    }



}