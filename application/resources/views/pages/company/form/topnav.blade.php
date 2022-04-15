                <!-- Nav tabs -->
				
                <ul class="nav employee-tab" role="tablist">
				
				 <!--profile-->

                    <li class="nav-item logo-employee">

                       {{ cleanLang(__('lang.company')) }} 

                    </li>

                    <!--profile-->

                   <li class="nav-item">

                        <a class="nav-link tabs-menu-item {{ $page['tabmenu_profile'] ?? '' }}"

                            href="{{ $page['tabmenu_profile_url'] ?? '' }}" role="tab">{{ cleanLang(__('lang.profile')) }}</a>

                    </li>

                    
					
					<!--daily_report-->

                   <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request {{ $page['tabmenu_daily_report'] ?? '' }}"

                            data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container" id="tabs-menu-daily_report"    

							data-dynamic-url="{{ url('employee/daily_report') }}"
							
							data-url="{{ url('employee/dr') }}"

                            href="#employee_ajaxtab" role="tab">Organization charts</a> 

                    </li>
					
					 

                </ul>