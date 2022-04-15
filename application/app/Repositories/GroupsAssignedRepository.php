<?php/** -------------------------------------------------------------------------------- * This repository class manages all the data absctration for units * * @package    Grow CRM * @author     NextLoop *----------------------------------------------------------------------------------*/namespace App\Repositories;use App\Models\GroupAssigned;use Illuminate\Http\Request;use Log;class GroupsAssignedRepository  {    /**     * The groups repository instance.     */    protected $group_assigned;    /**     * Inject dependecies     */    public function __construct(GroupAssigned $group_assigned) {        $this->group_assigned = $group_assigned;    }    /**     * Search model     * @param int $id optional for getting a single, specified record     * @return object unit collection     */    public function search($id = '') {        $groups = $this->group_assigned->newQuery();        //joins        //$units->leftJoin('users', 'users.id', '=', 'units.unit_creatorid');        // all client fields        $groups->selectRaw('groupassigned_userid,groupassigned_groupid');        if (is_numeric($id)) {            $groups->where('groupassigned_groupid', $id);        }        // Get the results and return them.        return $groups->get();    }			public function search_employee($id = '') {        $groups = $this->group_assigned->newQuery();        //joins        $groups->leftJoin('users', 'users.id' , '=', 'group_employee_assigned.groupassigned_userid');        // all client fields        $groups->selectRaw('*');        if (is_numeric($id)) {            $groups->where('group_id', $id);        }        //default sorting        $groups->orderBy('first_name', 'asc');        // Get the results and return them.				        return $groups->get();    }    /**     * Create a new record     * @return mixed int|bool     */    public function add($id) {        //save new user				$list = [];              		if (request()->filled('assigned')) {            foreach (request('assigned') as $user) {									$groups = new $this->group_assigned;                 $groups->groupassigned_groupid = $id;				                $groups->groupassigned_userid = $user;   				                $groups->groupassigned_creatorid = auth()->id();                                $groups->save();                $list[] = $user;            }            //return array of users            return $list;        }        return $list;    }	public function delete($group_id = '') {		$query = $this->group_assigned->newQuery();        $query->where('groupassigned_groupid', '=', $group_id);        $query->delete();    }    		public function unassign($id = '') {		$query = $this->group_assigned->newQuery();        $query->where('groupassigned_id', '=', $id);        $query->delete();    }    }