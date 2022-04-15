<?php/** -------------------------------------------------------------------------------- * This classes renders the response for the [index] process for the employee * controller * @package    Grow CRM * @author     NextLoop *----------------------------------------------------------------------------------*/namespace App\Http\Responses\Rooms;use Illuminate\Contracts\Support\Responsable;use Log;class IndexResponse implements Responsable {    private $payload;    public function __construct($payload = array()) {        $this->payload = $payload;    }    /**     * render the view for employee members     *     * @param  \Illuminate\Http\Request  $request     * @return \Illuminate\Http\Response     */    public function toResponse($request) {        //set all data to arrays        foreach ($this->payload as $key => $value) {            $$key = $value;			        }        //was this call made from an embedded page/ajax or directly on employee page        if (request('source') == 'ext' || request('action') == 'search' || request()->ajax()) {			$template = 'pages/rooms/tabswrapper';            $dom_container = '#embed-content-container';			$dom_action = 'replace';            //render the view and save to json            $html = view($template, compact('page', 'chats','mygroup','groups','list_employee','list_employee_inactive'))->render();            $jsondata['dom_html'][] = array(                'selector' => $dom_container,                'action' => $dom_action,                'value' => $html);                        //ajax response            return response()->json($jsondata);        } else {            //standard view            $page['url'] = '';            $page['loading_target'] = 'embed-content-container';            $page['visibility_show_load_more'] = false;            return view('pages/rooms/wrapper', compact('page', 'chats','mygroup','groups','list_employee','list_employee_inactive'))->render();        }    }}