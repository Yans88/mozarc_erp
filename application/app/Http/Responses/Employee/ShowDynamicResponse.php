<?php



/** --------------------------------------------------------------------------------

 * This classes renders the response for the [create] process for the team

 * controller

 * @package    Grow CRM

 * @author     NextLoop

 *----------------------------------------------------------------------------------*/



namespace App\Http\Responses\Employee;

use Illuminate\Contracts\Support\Responsable;



class ShowDynamicResponse implements Responsable {



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

    public function toResponse($request) {



        //set all data to arrays

        foreach ($this->payload as $key => $value) {

            $$key = $value;

        }
        
        $selector = '#embed-content-container';
		$html = '';		
		if($section == 'meeting_minutes' || $section == 'meeting_m' ){
            $html = view('pages/employee/form/meeting-minutes', compact('page','users','daily_reports','meeting_minutes'))->render();
        }
		if($section == 'review' || $section == 'review_content' ){
            $html = view('pages/employee/form/reviews', compact('page','users','daily_reports','reviews'))->render();
        }
        if($section == 'dr' || $section == 'daily_report' ){
            $html = view('pages/employee/form/dr', compact('page','users','daily_reports','meeting_minutes'))->render();
        }
        else if($section === 'payment' || $section === 'payment_content'){
            $html = view('pages/employee/form/payment', compact('page','users'))->render();
        }
	
		
		$jsondata['dom_html'][] = array(

            'selector' => $selector,

            'action' => 'replace',

            'value' => $html);


        //render the form
		

              
        
		
		// return $html;

        return response()->json($jsondata);



    }



}

