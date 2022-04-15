<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [edit] process for the team
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Employee;
use Illuminate\Contracts\Support\Responsable;

class EditResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view for team employee
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {        //set all data to arrays        foreach ($this->payload as $key => $value) {            $$key = $value;        }        $html = view('pages/employee/form/wrapper', compact('page', 'list_employee_inactive','users','groups'))->render();                				return $html;    }

}
