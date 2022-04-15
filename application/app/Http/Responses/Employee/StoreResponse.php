<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store] process for the team
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Employee;
use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }


    /**
     * render the view for team members
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {        //set all data to arrays        foreach ($this->payload as $key => $value) {            $$key = $value;        }				$html ='<ul class="list-group-employee" id="list_employee_inactive">';		$cnt = count($list_employee_inactive);		if((int)$cnt > 0){						foreach($list_employee_inactive as $lei){				$html .= '<li class="list-group-item list-employee">'.$lei->first_name.'</li>';			}					}		$html .='</ul>';		$jsondata['dom_html'][] = array(            'selector' => '#list_employee_inactive',            'action' => 'replace',            'value' => $html);        //notice        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));        //response        return response()->json($jsondata);    }

}
