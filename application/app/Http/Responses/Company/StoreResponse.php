<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store] process for the team
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Company;
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
    public function toResponse($request) {        //set all data to arrays        foreach ($this->payload as $key => $value) {            $$key = $value;        }				        //notice        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));        //response        return response()->json($jsondata);    }

}
