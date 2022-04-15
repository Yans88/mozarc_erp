                <!-- Nav tabs -->
				
                <ul class="nav employee-tab" role="tablist">
				
				 <!--profile-->

                    <li class="nav-item logo-employee">

                       <?php echo e(cleanLang(__('lang.company'))); ?> 

                    </li>

                    <!--profile-->

                   <li class="nav-item">

                        <a class="nav-link tabs-menu-item <?php echo e($page['tabmenu_profile'] ?? ''); ?>"

                            href="<?php echo e($page['tabmenu_profile_url'] ?? ''); ?>" role="tab"><?php echo e(cleanLang(__('lang.profile'))); ?></a>

                    </li>

                    
					
					<!--daily_report-->

                   <li class="nav-item">

                        <a class="nav-link  tabs-menu-item js-dynamic-url js-ajax-ux-request <?php echo e($page['tabmenu_daily_report'] ?? ''); ?>"

                            data-toggle="tab" data-loading-class="loading-tabs" data-loading-target="embed-content-container" id="tabs-menu-daily_report"    

							data-dynamic-url="<?php echo e(url('employee/daily_report')); ?>"
							
							data-url="<?php echo e(url('employee/dr')); ?>"

                            href="#employee_ajaxtab" role="tab">Organization charts</a> 

                    </li>
					
					 

                </ul><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/pages/company/form/topnav.blade.php ENDPATH**/ ?>