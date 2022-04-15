                <!-- Nav tabs -->
				
                <ul class="nav employee-tab" role="tablist">
				
				 <!--profile-->

                    <li class="nav-item logo-employee">

                       <?php echo e(cleanLang(__('lang.employee'))); ?> 

                    </li>

                    <!--profile-->

                   <li class="nav-item">

                        <a class="nav-link tabs-menu-item <?php echo e($page['tabmenu_profile'] ?? ''); ?>"

                            href="<?php echo e($page['tabmenu_profile_url'] ?? ''); ?>" role="tab"><?php echo e(cleanLang(__('lang.profile'))); ?></a>

                    </li>

                    <!--payment-->

                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_payment'] ?? ''); ?>"

                            data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container" id="tabs-menu-payment"     
                            
                            data-dynamic-url="<?php echo e(url('employee/payment')); ?><?php echo e(isset($users->id) && $users->id ? '?id='.$users->id ?? '' : ''); ?>"

                            data-url="<?php echo e(url('employee/payment_content')); ?><?php echo e(isset($users->id) && $users->id ? '?id='.$users->id ?? '' : ''); ?>"

                            href="#employee_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.payment'))); ?></a>

                    </li>
					
					<!--daily_report-->

                   <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_daily_report'] ?? ''); ?>"

                            data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container" id="tabs-menu-daily_report"    

							data-dynamic-url="<?php echo e(url('employee/daily_report')); ?>"
							
							data-url="<?php echo e(url('employee/dr')); ?>"

                            href="#employee_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.daily_report'))); ?></a> 

                    </li>
					
					 <!--leave-->
					
					<li class="nav-item">

						<a class="nav-link tabs-menu-item   js-dynamic-url js-ajax-ux-request" data-toggle="tab"

							id="tabs-menu-details" data-loading-class="loading-tabs"

							data-loading-target="embed-content-container"
							

							href="#employee_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.leave'))); ?></a>

					</li>

                    <!--calendar-->

                    <li class="nav-item">

                        <a class="nav-link tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_calendar'] ?? ''); ?>"

                            data-toggle="tab" data-loading-class="loading-tabs" id="tabs-menu-calendar" data-loading-target="embed-content-container"                            

                            href="#employee_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.calendar'))); ?></a>

                    </li>                   


                    <!--survey-->

                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_survey'] ?? ''); ?>"

                            id="tabs-menu-survey" data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"                            

                            href="#employee_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.survey'))); ?></a>

                    </li>
					

					<!--review-->

                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_review'] ?? ''); ?>"

                            id="tabs-menu-review" data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"
							
							data-dynamic-url="<?php echo e(url('employee/review')); ?>"
							
							data-url="<?php echo e(url('employee/review_content')); ?>"   

                            href="#employee_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.review'))); ?></a>

                    </li>
					
					
					<!--meeting_minutes-->

                    
                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_meeting_minutes'] ?? ''); ?>"

                            id="tabs-menu-meeting_minutes" data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"    

							data-dynamic-url="<?php echo e(url('employee/meeting_minutes')); ?>"
							
							data-url="<?php echo e(url('employee/meeting_m')); ?>"                          

                            href="#employee_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.meeting_minutes'))); ?></a>

                    </li>
					
					<!--files-->

                    <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_files'] ?? ''); ?>"

                            id="tabs-menu-files" data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container"    

							data-dynamic-url="<?php echo e(url('/employee')); ?>/employee-files"

                            data-url="<?php echo e(url('employee/files')); ?>?source=ext&page=1&fileresource_type=employee"

                            href="#employee_ajaxtab" role="tab"><?php echo e(cleanLang(__('lang.files'))); ?></a>

                    </li>

                </ul><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/pages/employee/form/topnav.blade.php ENDPATH**/ ?>