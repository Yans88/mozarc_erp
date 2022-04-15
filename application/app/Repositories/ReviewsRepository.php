<?php/** -------------------------------------------------------------------------------- * This repository class manages all the data absctration for units * * @package    Grow CRM * @author     NextLoop *----------------------------------------------------------------------------------*/namespace App\Repositories;use App\Models\Reviews;use Illuminate\Http\Request;use Log;class ReviewsRepository  {    /**     * The groups repository instance.     */    protected $reviews;    /**     * Inject dependecies     */    public function __construct(Reviews $reviews) {        $this->reviews = $reviews;    }    /**     * Search model     * @param int $id optional for getting a single, specified record     * @return object unit collection     */    public function search($id = '') {        $reviews = $this->reviews->newQuery();        //joins        //$units->leftJoin('users', 'users.id', '=', 'units.unit_creatorid');        // all client fields        $reviews->selectRaw('*');        if (is_numeric($id)) {            $reviews->where('reviewemployee_id', $id);        }        //default sorting        $reviews->orderBy('review_created', 'desc');        // Get the results and return them.        return $reviews->paginate(config('system.settings_system_pagination_limits'));    }	    /**     * Create a new record     * @return mixed int|bool     */    public function create($id=0) {        if((int)$id > 0){			if (!$reviews = $this->reviews->find($id)) {				return false;			}		}else{			$reviews = new $this->reviews;		}                //data        $reviews->review_title = request('review_title');            $reviews->your_day_general = request('re_your_day_general');                $reviews->review_description = request('review_description');                $reviews->review_creatorid = auth()->id();            //save and return id        if ($reviews->save()) {            return $reviews->reviewemployee_id;        } else {            return false;        }    }   }