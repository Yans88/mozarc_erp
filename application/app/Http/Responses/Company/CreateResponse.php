<?php



/** --------------------------------------------------------------------------------

 * This classes renders the response for the [create] process for the team

 * controller

 * @package    Grow CRM

 * @author     NextLoop

 *----------------------------------------------------------------------------------*/



namespace App\Http\Responses\Company;

use Illuminate\Contracts\Support\Responsable;



class CreateResponse implements Responsable {



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
		
		$html = view('pages/company/form/wrapper', compact('page','company','groups'))->render();
		
		
		return $html;

        // return response()->json($jsondata);



    }



}

