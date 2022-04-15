<div class="row">

    <div class="col-lg-12">

       
			
		<div class="spacer row">

            <div class="col-sm-12 col-lg-8">

                <span class="title"><?php echo e(cleanLang(__('lang.department'))); ?></span class="title">

            </div>

            <div class="col-sm-12 col-lg-4">

                <div class="switch  text-right">

                    <label>

                        <input type="checkbox" name="show_department" id="show_department" onclick="selected_one(this.id)"

                            class="js-switch-toggle-hidden-content" data-target="target_selected_task_departmentid">

                        <span class="lever switch-col-light-blue"></span>

                    </label>

                </div>

            </div>

        </div>
		
		<!-- selected department -->
		<div class="hidden" id="target_selected_task_departmentid">
			<div class="form-group row">
				<label

					class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.department'))); ?></label>

				<div class="col-sm-12 col-lg-9">

					<select name="task_departmentid" id="task_departmentid"

						class="projects_assigned_toggle form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"

						data-assigned-dropdown="assigned"

						data-ajax--url="<?php echo e(url('/')); ?>/feed/department?ref=general"></select>

				</div>

			</div>
        </div>
		
		<div class="spacer row">

            <div class="col-sm-12 col-lg-8">

                <span class="title"><?php echo e(cleanLang(__('lang.client'))); ?></span class="title">

            </div>

            <div class="col-sm-12 col-lg-4">

                <div class="switch  text-right">

                    <label>

                        <input type="checkbox" name="show_client" id="show_client"  onclick="selected_one(this.id)"

                            class="js-switch-toggle-hidden-content" data-target="target_selected_task_clientid ">

                        <span class="lever switch-col-light-blue"></span>

                    </label>

                </div>

            </div>

        </div>
		
		<!-- selected client -->
		<div class="hidden" id="target_selected_task_clientid">
			<div class="form-group row">
				<label

					class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.client'))); ?></label>

				<div class="col-sm-12 col-lg-9">

					<select name="task_clientid" id="task_clientid"

						class="projects_assigned_toggle form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"

						data-assigned-dropdown="assigned"

						data-ajax--url="<?php echo e(url('/')); ?>/feed/clients?ref=general"></select>

				</div>

			</div>
        </div>
		
		<div class="spacer row">

            <div class="col-sm-12 col-lg-8">

                <span class="title"><?php echo e(cleanLang(__('lang.lead'))); ?></span class="title">

            </div>

            <div class="col-sm-12 col-lg-4">

                <div class="switch  text-right">

                    <label>

                        <input type="checkbox" name="show_lead" id="show_lead" onclick="selected_one(this.id)"

                            class="js-switch-toggle-hidden-content" data-target="target_selected_task_leadid">

                        <span class="lever switch-col-light-blue"></span>

                    </label>

                </div>

            </div>

        </div>
		
		<!--leads-->
		<div class="hidden" id="target_selected_task_leadid">
			<div class="form-group row">
				<label

					class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.lead'))); ?></label>

				<div class="col-sm-12 col-lg-9">

					<select name="task_leadid" id="task_leadid"

						class="projects_assigned_toggle form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"

						data-assigned-dropdown="assigned"

						data-ajax--url="<?php echo e(url('/')); ?>/feed/leads?ref=general"></select>

				</div>

			</div>
        </div>
		
		
		<div class="spacer row">

            <div class="col-sm-12 col-lg-8">

                <span class="title"><?php echo e(cleanLang(__('lang.project'))); ?></span class="title">

            </div>

            <div class="col-sm-12 col-lg-4">

                <div class="switch  text-right">

                    <label>

                        <input type="checkbox" name="show_task_project" id="show_task_project" onclick="selected_one(this.id)"

                            class="js-switch-toggle-hidden-content" data-target="target_selected_task_projectid">

                        <span class="lever switch-col-light-blue"></span>

                    </label>

                </div>

            </div>

        </div>
		
		<!-- selected project -->
		<div class="hidden" id="target_selected_task_projectid">
			<div class="form-group row">
				<label

					class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.project'))); ?></label>

				<div class="col-sm-12 col-lg-9">

					<select name="task_projectid" id="task_projectid"

						class="projects_assigned_toggle form-control form-control-sm js-select2-basic-search-modal select2-hidden-accessible"

						data-assigned-dropdown="assigned"

						data-ajax--url="<?php echo e(url('/')); ?>/feed/projects?ref=general"></select>

				</div>

			</div>
        </div>
		
		<div class="spacer row">

            <div class="col-sm-12 col-lg-8">

                <span class="title"><?php echo e(cleanLang(__('lang.private'))); ?></span class="title">

            </div>

            <div class="col-sm-12 col-lg-4">

                <div class="switch  text-right">

                    <label>

                        <input type="checkbox" name="show_task_private" id="show_task_private" onclick="selected_one(this.id)"

                            class="js-switch-toggle-hidden-content">

                        <span class="lever switch-col-light-blue"></span>

                    </label>

                </div>

            </div>

        </div>
		
				

       
        
        <!--title-->

        <div class="form-group row">

            <label

                class="col-sm-12 col-lg-3 text-left control-label col-form-label required"><?php echo e(cleanLang(__('lang.title'))); ?>*</label>

            <div class="col-sm-12 col-lg-9">

                <input type="text" class="form-control form-control-sm" id="task_title" name="task_title"

                    placeholder="">

            </div>

        </div>




        <!--due date-->

        <?php if(config('visibility.tasks_standard_features')): ?>

        <div class="form-group row">

            <label

                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.target_date'))); ?></label>

            <div class="col-sm-12 col-lg-9">

                <input type="text" class="form-control form-control-sm pickadate" name="task_date_due"

                    autocomplete="off" placeholder="">

                <input class="mysql-date" type="hidden" name="task_date_due" id="task_date_due">

            </div>

        </div>

        <?php endif; ?>





        <!--assigned [roles]-->

        <?php if(auth()->user()->role->role_assign_tasks == 'yes' && config('visibility.tasks_standard_features')): ?>
			
		<div id="target_selected_assigned_user">

        <div class="form-group row">

            <label

                class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.assign_users'))); ?>


                <a class="align-middle font-16 toggle-collapse" href="#assigning_info" role="button"><i

                        class="ti-info-alt text-themecontrast"></i></a></label>

            <div class="col-sm-12 col-lg-9">

                <?php if(config('visibility.projects_assigned_users')): ?>

                <select name="assigned" id="assigned"

                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"

                    multiple="multiple" tabindex="-1" aria-hidden="true">

                    <?php $__currentLoopData = config('project.assigned'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

                <?php else: ?>

                <select name="assigned" id="assigned"

                    class="form-control form-control-sm select2-basic select2-multiple select2-tags select2-hidden-accessible"

                    multiple="multiple" tabindex="-1" aria-hidden="true">
					
					<?php $__currentLoopData = $assigned; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <option value="<?php echo e($user->id); ?>"><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></option>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </select>

                <?php endif; ?>

            </div>
			
            </div>

        </div>



        <div class="collapse" id="assigning_info">

            <div class="alert alert-info">

                <?php echo e(cleanLang(__('lang.assigning_users_to_a_task_info'))); ?>


            </div>

        </div>





        <!--custom fields-->

        <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="form-group row">

            <label

                class="col-sm-12 col-lg-3 text-left control-label col-form-label <?php echo e(runtimeCustomFieldsRequiredCSS($field->customfields_required)); ?>">

                <?php echo e($field->customfields_title); ?><?php echo e(runtimeCustomFieldsRequiredAsterix($field->customfields_required)); ?></label>

            <div class="col-sm-12 col-lg-9">

                <input type="text" class="form-control form-control-sm" id="<?php echo e($field->customfields_name); ?>"

                    name="<?php echo e($field->customfields_name); ?>" value="<?php echo e($task[$field->customfields_name] ?? ''); ?>">

            </div>

        </div>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endif; ?>



        <div class="line"></div>

        <!--spacer-->

        <div class="spacer row">

            <div class="col-sm-12 col-lg-8">

                <span class="title"><?php echo e(cleanLang(__('lang.description'))); ?></span class="title">

            </div>

            <div class="col-sm-12 col-lg-4">

                <div class="switch  text-right">

                    <label>

                        <input type="checkbox" name="show_more_settings_tasks" id="show_more_settings_tasks"

                            class="js-switch-toggle-hidden-content" data-target="task_description_section">

                        <span class="lever switch-col-light-blue"></span>

                    </label>

                </div>

            </div>

        </div>

        <!--spacer-->



        <!--description-->

        <div class="hidden" id="task_description_section">

            <div class="form-group row">

                <div class="col-sm-12">

                    <textarea id="project_description" name="task_description"

                        class="tinymce-textarea"><?php echo e($task->task_description ?? ''); ?></textarea>

                </div>

            </div>

        </div>



        <?php if(config('visibility.task_modal_additional_options')): ?>

        <!--spacer-->

        <div class="spacer row">

            <div class="col-sm-12 col-lg-8">

                <span class="title"><?php echo e(cleanLang(__('lang.options'))); ?></span class="title">

            </div>

            <div class="col-sm-12 col-lg-4">

                <div class="switch  text-right">

                    <label>

                        <input type="checkbox" name="show_more_settings_tasks2" id="show_more_settings_tasks2"

                            class="js-switch-toggle-hidden-content" data-target="additional_information_section">

                        <span class="lever switch-col-light-blue"></span>

                    </label>

                </div>

            </div>

        </div>

        <!--spacer-->

        <!--option toggle-->

        <div class="hidden" id="additional_information_section">





            <!--task status-->

            <?php if(request('status') != '' && array_key_exists(request('status'), config('settings.task_statuses'))): ?>

            <input type="hidden" name="task_status" value="<?php echo e(request('status')); ?>">

            <?php else: ?>

            <div class="form-group row">

                <label for="example-month-input"

                    class="col-sm-12 col-lg-3 col-form-label text-left  required"><?php echo e(cleanLang(__('lang.status'))); ?></label>

                <div class="col-sm-12 col-lg-9">

                    <select class="select2-basic form-control form-control-sm" id="task_status" name="task_status">

                        <?php $__currentLoopData = config('settings.task_statuses'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option value="<?php echo e($key); ?>"><?php echo e(runtimeLang($key)); ?></option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>

                </div>

            </div>

            <?php endif; ?>









            <!--task priority-->

            <div class="form-group row">

                <label for="example-month-input"

                    class="col-sm-12 col-lg-3 col-form-label text-left"><?php echo e(cleanLang(__('lang.priority'))); ?></label>

                <div class="col-sm-12 col-lg-9">

                    <select class="select2-basic form-control form-control-sm" id="task_priority" name="task_priority">

                        <option value="normal"><?php echo e(cleanLang(__('lang.normal'))); ?></option>

                        <option value="high"><?php echo e(cleanLang(__('lang.high'))); ?></option>

                        <option value="urgent"><?php echo e(cleanLang(__('lang.urgent'))); ?></option>

                        <option value="low"><?php echo e(cleanLang(__('lang.low'))); ?></option>

                    </select>

                </div>

            </div>



            <!--[toggled] project options-->

            <div class="toggle_task_type add_task_toggle_container_project">

                <div class="form-group form-group-checkbox row">

                    <div class="col-12 p-t-5">

                        <div class="pull-left min-w-200">

                            <label><?php echo e(cleanLang(__('lang.visible_to_client'))); ?></label>

                        </div>

                        <div class="pull-left p-l-10">

                            <?php if(isset($page['section']) && $page['section'] == 'create'): ?>

                            <input type="checkbox" id="task_client_visibility" name="task_client_visibility"

                                <?php echo e(runtimeTasksDefaults('task_client_visibility')); ?>


                                class="filled-in chk-col-light-blue">

                            <?php endif; ?>

                            <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>

                            <input type="checkbox" id="task_client_visibility" name="task_client_visibility"

                                class="filled-in chk-col-light-blue">

                            <?php endif; ?>

                            <label for="task_client_visibility"></label>

                        </div>

                    </div>

                </div>

                <div class="form-group form-group-checkbox row">

                    <div class="col-12 p-t-5">

                        <div class="pull-left min-w-200">

                            <label><?php echo e(cleanLang(__('lang.billable'))); ?></label>

                        </div>

                        <div class="pull-left p-l-10">

                            <?php if(isset($page['section']) && $page['section'] == 'create'): ?>

                            <input type="checkbox" id="task_billable" name="task_billable"

                                <?php echo e(runtimeTasksDefaults('task_billable')); ?> class="filled-in chk-col-light-blue">

                            <?php endif; ?>

                            <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>

                            <input type="checkbox" id="task_billable" name="task_billable"

                                class="filled-in chk-col-light-blue">

                            <?php endif; ?>

                            <label for="task_billable"></label>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!--option toggle-->

        <?php endif; ?>





        <!--other details-->

        <div class="spacer row">

            <div class="col-sm-8">

                <span class="title"><?php echo e(cleanLang(__('lang.other_details'))); ?></span class="title">

            </div>

            <div class="col-sm-4 text-right">

                <div class="switch">

                    <label>

                        <input type="checkbox" class="js-switch-toggle-hidden-content" data-target="edit_task_options">

                        <span class="lever switch-col-light-blue"></span>

                    </label>

                </div>

            </div>

        </div>



        <!--other details-->

        <div class="hidden" id="edit_task_options">





            <!--tags-->

            <div class="form-group row">

                <label

                    class="col-sm-12 col-lg-3 text-left control-label col-form-label"><?php echo e(cleanLang(__('lang.tags'))); ?></label>

                <div class="col-sm-12 col-lg-9">

                    <select name="tags" id="tags"

                        class="form-control form-control-sm select2-multiple <?php echo e(runtimeAllowUserTags()); ?> select2-hidden-accessible"

                        multiple="multiple" tabindex="-1" aria-hidden="true">

                        <!--array of selected tags-->

                        <?php if(isset($page['section']) && $page['section'] == 'edit'): ?>

                        <?php $__currentLoopData = $lead->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <?php $selected_tags[] = $tag->tag_title ; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php endif; ?>

                        <!--/#array of selected tags-->

                        <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <option value="<?php echo e($tag->tag_title); ?>"

                            <?php echo e(runtimePreselectedInArray($tag->tag_title ?? '', $selected_tags  ?? [])); ?>>

                            <?php echo e($tag->tag_title); ?>


                        </option>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </select>

                </div>

            </div>





        </div>





        <!--redirect to project-->

        <?php if(config('visibility.task_show_task_option')): ?>

        <div class="line"></div>

        <div class="form-group form-group-checkbox row">

            <div class="col-12 text-left p-t-5">

                <input type="checkbox" id="show_after_adding" name="show_after_adding"

                    class="filled-in chk-col-light-blue" checked="checked">

                <label for="show_after_adding"><?php echo e(cleanLang(__('lang.show_task_after_adding'))); ?></label>

            </div>

        </div>

        <?php endif; ?>



        <!--pass source-->

        <input type="hidden" name="source" value="<?php echo e(request('source')); ?>">

        <input type="hidden" name="ref" value="<?php echo e(request('ref')); ?>">



        <!--notes-->

        <div class="row">

            <div class="col-12">

                <div><small><strong>* <?php echo e(cleanLang(__('lang.required'))); ?></strong></small></div>

            </div>

        </div>

    </div>

</div>
<script>
	var lead_id_task = localStorage.getItem("lead_id_task") ? localStorage.getItem("lead_id_task") : '';
	var lead_title_task = localStorage.getItem("lead_title_task") ? localStorage.getItem("lead_title_task") : '';
	if(lead_id_task > 0){
		$('#show_lead').click();
		var newOption = $("<option selected='selected'></option>").val(lead_id_task).text(lead_title_task); 
		$("#task_leadid").append(newOption).trigger('change');	
		
		
	}
	function selected_one(id){
		if(id == "show_department"){
			document.getElementById("show_client").checked = false;			
			document.getElementById("show_lead").checked = false;			
			document.getElementById("show_task_project").checked = false;			
			document.getElementById("show_task_private").checked = false;	
			document.getElementById("target_selected_task_leadid").style.display = "none";									
			document.getElementById("target_selected_task_clientid").style.display = "none";									
			document.getElementById("target_selected_task_projectid").style.display = "none";													
			$("#task_departmentid").val('').trigger('change');
			$("#task_clientid").val('').trigger('change');
			$("#task_leadid").val('').trigger('change');
			$("#task_projectid").val('').trigger('change');
			$("#assigned").val('').trigger('change');
		}
		if(id == "show_client"){
			document.getElementById("show_department").checked = false;			
			document.getElementById("show_lead").checked = false;			
			document.getElementById("show_task_project").checked = false;			
			document.getElementById("show_task_private").checked = false;	
			document.getElementById("target_selected_task_leadid").style.display = "none";									
			document.getElementById("target_selected_task_departmentid").style.display = "none";									
			document.getElementById("target_selected_task_projectid").style.display = "none";			
			$("#task_departmentid").val('').trigger('change');
			$("#task_clientid").val('').trigger('change');
			$("#task_leadid").val('').trigger('change');
			$("#task_projectid").val('').trigger('change');	
			$("#assigned").val('').trigger('change');
		}
		if(id == "show_lead"){
			document.getElementById("show_department").checked = false;			
			document.getElementById("show_client").checked = false;			
			document.getElementById("show_task_project").checked = false;			
			document.getElementById("show_task_private").checked = false;	
			document.getElementById("target_selected_task_clientid").style.display = "none";									
			document.getElementById("target_selected_task_departmentid").style.display = "none";									
			document.getElementById("target_selected_task_projectid").style.display = "none";					
			$("#task_departmentid").val('').trigger('change');
			$("#task_clientid").val('').trigger('change');
			$("#task_leadid").val('').trigger('change');
			$("#task_projectid").val('').trigger('change');
			$("#assigned").val('').trigger('change');
		}
		if(id == "show_task_project"){
			document.getElementById("show_department").checked = false;			
			document.getElementById("show_client").checked = false;			
			document.getElementById("show_lead").checked = false;			
			document.getElementById("show_task_private").checked = false;	
			document.getElementById("target_selected_task_clientid").style.display = "none";									
			document.getElementById("target_selected_task_departmentid").style.display = "none";									
			document.getElementById("target_selected_task_leadid").style.display = "none";
			$("#task_departmentid").val('').trigger('change');
			$("#task_clientid").val('').trigger('change');
			$("#task_leadid").val('').trigger('change');
			$("#task_projectid").val('').trigger('change');	
			$("#assigned").val('').trigger('change');
		}
		if(id == "show_task_private"){
			document.getElementById("show_department").checked = false;			
			document.getElementById("show_client").checked = false;			
			document.getElementById("show_lead").checked = false;			
			document.getElementById("show_task_project").checked = false;	
			document.getElementById("target_selected_task_clientid").style.display = "none";									
			document.getElementById("target_selected_task_departmentid").style.display = "none";									
			document.getElementById("target_selected_task_leadid").style.display = "none";
			document.getElementById("target_selected_task_projectid").style.display = "none";
			$("#task_departmentid").val('').trigger('change');
			$("#task_clientid").val('').trigger('change');
			$("#task_leadid").val('').trigger('change');
			$("#task_projectid").val('').trigger('change');	
			$("#assigned").val('').trigger('change');
		}
		
		if(document.getElementById("show_task_private").checked){
			document.getElementById("target_selected_assigned_user").style.display = "none";			
		}else{
			document.getElementById("target_selected_assigned_user").style.display = "block";
		}
	}
	
	$("#commonModalCloseButton").click(function(){
		localStorage.removeItem("lead_id_task");
		localStorage.removeItem("lead_title_task");
	});
	
	$('.close').click(function(){
		localStorage.removeItem("lead_id_task");
		localStorage.removeItem("lead_title_task");
	});	
</script><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/pages/leads/components/modals/add-edit-task-inc.blade.php ENDPATH**/ ?>