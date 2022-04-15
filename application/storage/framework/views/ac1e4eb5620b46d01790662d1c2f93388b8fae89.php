<div class="card-task" id="card-task">

    <div class="x-heading clearfix">
        <i class="ti-menu-alt"></i><?php echo e(cleanLang(__('lang.task'))); ?>

    </div>

    <table id="tasks-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10"

        data-url="<?php echo e(url('/')); ?>/tasks/timer-poll/" data-type="form" data-ajax-type="post"

        data-form-id="tasks-list-table">

        <thead>

            <tr>

                <th class="tasks_col_title">

                    <a class="js-ajax-ux-request js-list-sorting" id="sort_task_title" href="javascript:void(0)"

                        data-url="<?php echo e(urlResource('/tasks?action=sort&orderby=task_title&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.title'))); ?><span

                            class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>

                </th>

                <th class="tasks_col_deadline">

                    <a class="js-ajax-ux-request js-list-sorting" id="sort_task_date_due"

                        href="javascript:void(0)"

                        data-url="<?php echo e(urlResource('/tasks?action=sort&orderby=task_date_due&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.deadline'))); ?><span

                            class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>

                </th>

                <th class="tasks_col_assigned"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.assigned'))); ?></a></th>

                <th class="tasks_col_status">

                    <a class="js-ajax-ux-request js-list-sorting" id="sort_task_status"

                        href="javascript:void(0)"

                        data-url="<?php echo e(urlResource('/tasks?action=sort&orderby=task_status&sortorder=asc')); ?>"><?php echo e(cleanLang(__('lang.status'))); ?><span

                            class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>

                </th>

                <th class="tasks_col_action"><a href="javascript:void(0)"><?php echo e(cleanLang(__('lang.action'))); ?></a></th>

            </tr>

        </thead>

        <tbody id="card-tasks-container">
            <!--dynamic content here-->
        </tbody>

        <tfoot>

            <tr>

                <td colspan="20">

                    <!--load more button-->

                    <?php echo $__env->make('misc.load-more-button', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <!--load more button-->

                </td>

            </tr>

        </tfoot>

    </table>

    <?php if($lead->permission_edit_lead): ?>

    <div class="x-action">
			<a href="javascript:void(0)" class="edit-add-modal-button js-ajax-ux-request reset-target-modal-form " data-toggle="modal" data-target="#commonModal" data-url="<?php echo e(url('tasks/create?taskresource_type=leads&taskresource_id='.$lead->lead_id)); ?>" data-loading-target="commonModalBody" data-modal-title="Add A New Task" data-action-url="<?php echo e(url('tasks?taskresource_type=leads&count=0&taskresource_id='.$lead->lead_id)); ?>" data-action-method="POST" data-action-ajax-class="" data-modal-size="" data-action-ajax-loading-target="commonModalBody" data-save-button-class="" data-project-progress="0" onClick="newTask()">Add new task</a> 
			<!--
        <a href="javascript:void(0)" class="js-card-task-toggle" id="card-task-add-new"

            onClick="$('.modal').modal('hide'); $('#btn-add-task').click();">Add new task</a>
			
			!-->
    </div>

    <?php endif; ?>

</div>
<br />
<br />
<br />
<script>
localStorage.removeItem("lead_id_task");
localStorage.removeItem("lead_title_task");
function newTask(){
	$('.modal').modal('hide');
	var lead_title = "<?php echo e($lead->lead_title); ?>";
	var lead_id = "<?php echo e($lead->lead_id); ?>";
	$('.modal').modal('hide');	
	localStorage.setItem("lead_id_task", lead_id);
	localStorage.setItem("lead_title_task", lead_title);
}

</script><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/pages/lead/components/tasks.blade.php ENDPATH**/ ?>