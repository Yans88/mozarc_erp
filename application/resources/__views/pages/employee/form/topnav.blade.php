                <!-- Nav tabs -->
				

                <ul class="nav employee-tab" role="tablist">
				
				 <!--profile-->

                    <li class="nav-item logo-employee">

                       {{ cleanLang(__('lang.employee')) }} 

                    </li>

                    <!--profile-->

                   <li class="nav-item">

                        <a class="nav-link tabs-menu-item {{ $page['tabmenu_profile'] ?? '' }}"

                            href="{{ $page['tabmenu_profile_url'] ?? '' }}" role="tab">{{ cleanLang(__('lang.profile')) }}</a>

                    </li>

                    <!--payment-->

                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request {{ $page['tabmenu_payment'] ?? '' }}"

                            data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container" id="tabs-menu-payment"     
                            
                            data-dynamic-url="{{ url('employee/payment')}}"

                            data-url="{{ url('employee/payment') }}"

                            href="#employee_ajaxtab" role="tab">{{ cleanLang(__('lang.payment')) }}</a>

                    </li>
					
					<!--daily_report-->

                   <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request {{ $page['tabmenu_daily_report'] ?? '' }}"

                            data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container" id="tabs-menu-daily_report"    

							data-dynamic-url="{{ url('employee/daily_report') }}"
							
							data-url="{{ url('employee/dr') }}"

                            href="#employee_ajaxtab" role="tab">{{ cleanLang(__('lang.daily_report')) }}</a> 

                    </li>
					
					 <!--leave-->
					
					<li class="nav-item">

						<a class="nav-link tabs-menu-item   js-dynamic-url js-ajax-ux-request" data-toggle="tab"

							id="tabs-menu-details" data-loading-class="loading-tabs"

							data-loading-target="embed-content-container"
							

							href="#employee_ajaxtab" role="tab">{{ cleanLang(__('lang.leave')) }}</a>

					</li>

                    <!--calendar-->

                    <li class="nav-item">

                        <a class="nav-link tabs-menu-item js-dynamic-url js-ajax-ux-request {{ $page['tabmenu_calendar'] ?? '' }}"

                            data-toggle="tab" data-loading-class="loading-tabs" id="tabs-menu-calendar" data-loading-target="embed-content-container"                            

                            href="#employee_ajaxtab" role="tab">{{ cleanLang(__('lang.calendar')) }}</a>

                    </li>                   


                    <!--survey-->

                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request {{ $page['tabmenu_survey'] ?? '' }}"

                            id="tabs-menu-survey" data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"                            

                            href="#employee_ajaxtab" role="tab">{{ cleanLang(__('lang.survey')) }}</a>

                    </li>
					

					<!--review-->

                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request {{ $page['tabmenu_review'] ?? '' }}"

                            id="tabs-menu-review" data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"                            

                            href="#employee_ajaxtab" role="tab">{{ cleanLang(__('lang.review')) }}</a>

                    </li>
					
					
					<!--meeting_minutes-->

                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request {{ $page['tabmenu_meeting_minutes'] ?? '' }}"

                            id="tabs-menu-meeting_minutes" data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"  id="tabs-menu-meeting_minutes"    

							data-dynamic-url="{{ url('employee/meeting_minutes') }}"
							
							data-url="{{ url('employee/meeting_m') }}"                          

                            href="#employee_ajaxtab" role="tab">{{ cleanLang(__('lang.meeting_minutes')) }}</a>

                    </li>
					
					<!--files-->

                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request {{ $page['tabmenu_files'] ?? '' }}"

                            id="tabs-menu-meeting_files" data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"                            

                            href="#employee_ajaxtab" role="tab">{{ cleanLang(__('lang.files')) }}</a>

                    </li>

                </ul>