<?php/** -------------------------------------------------------------------------------- * This repository class manages all the data absctration for units * * @package    Grow CRM * @author     NextLoop *----------------------------------------------------------------------------------*/namespace App\Repositories;use App\Models\Groups;use Illuminate\Http\Request;class GroupsRepository  {    /**     * The groups repository instance.     */    protected $groups;    /**     * Inject dependecies     */    public function __construct(Groups $groups) {        $this->groups = $groups;    }    /**     * Search model     * @param int $id optional for getting a single, specified record     * @return object unit collection     */    public function search($id = '') {        $groups = $this->groups->newQuery();        //joins        //$units->leftJoin('users', 'users.id', '=', 'units.unit_creatorid');        // all client fields        $groups->selectRaw('*');        if (is_numeric($id)) {            $groups->where('group_id', $id);        }		 if (request()->filled('search_query')) {            $groups->where('group_name', 'LIKE', '%' . request('search_query') . '%');        }        //default sorting        $groups->orderBy('group_name', 'asc');        // Get the results and return them.        return $groups->paginate(config('system.settings_system_pagination_limits'));    }	    /**     * Create a new record     * @return mixed int|bool     */    public function create() {        //save new user        $groups = new $this->groups;        //data        $groups->group_name = request('group_name');            //save and return id        if ($groups->save()) {            return $groups->group_id;        } else {            return false;        }    }    /**     * update a record     * @param int $id record id     * @return mixed bool or id of record     */    public function update($id) {        //get the record        if (!$groups = $this->groups->find($id)) {            return false;        }        //general        $groups->group_name = request('group_name');           //save        if ($groups->save()) {            return $groups->group_id;        } else {            return false;        }    }    public function get($id = '') {        //new query        $groups = $this->groups->newQuery();        //validation        if (!is_numeric($id)) {            return false;        }        $groups->where('group_id', $id);        return $groups->first();    }}