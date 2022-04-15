<?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<!--each row-->

<tr id="task_<?php echo e($task->task_id); ?>" class="task-<?php echo e($task->task_status); ?>">

    <td class="tasks_col_title td-edge">

        <!--for polling timers-->

        <input type="hidden" name="tasks[<?php echo e($task->task_id); ?>]" value="<?php echo e($task->assigned_to_me); ?>">

        <!--checkbox-->

        <span class="task_border td-edge-border <?php echo e(runtimeTaskStatusColors($task->task_status, 'background')); ?>"></span>

        <a class="show-modal-button reset-card-modal-form js-ajax-ux-request p-l-5" href="javascript:void(0)"

            data-toggle="modal" data-target="#cardModal" data-url="<?php echo e(urlResource('/tasks/'.$task->task_id)); ?>"

            data-loading-target="main-top-nav-bar"><span class="x-strike-through"

                id="table_task_title_<?php echo e($task->task_id); ?>">

                <?php echo e(str_limit($task->task_title ?? '---', 45)); ?></span></a>

    </td>
    <td class="tasks_col_deadline"><?php echo e(runtimeDate($task->task_date_due)); ?></td>
    <td class="tasks_col_assigned" id="tasks_col_assigned_<?php echo e($task->task_id); ?>">

        <!--assigned users-->

        <?php if(count($task->assigned) > 0): ?>

        <?php $__currentLoopData = $task->assigned->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <img src="<?php echo e($user->avatar); ?>" data-toggle="tooltip" title="<?php echo e($user->first_name); ?>" data-placement="top"

            alt="<?php echo e($user->first_name); ?>" class="img-circle avatar-xsmall">

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php else: ?>

        <span>---</span>

        <?php endif; ?>

        <!--assigned users-->

        <!--more users-->

        <?php if(count($task->assigned) > 2): ?>

        <?php $more_users_title = __('lang.assigned_users'); $users = $task->assigned; ?>

        <?php echo $__env->make('misc.more-users', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php endif; ?>

        <!--more users-->

    </td>
    <td class="tasks_col_status">

        <span

            class="label <?php echo e(runtimeTaskStatusColors($task->task_status, 'label')); ?>"><?php echo e(runtimeLang($task->task_status)); ?></span>

        <!--archived-->

        <?php if($task->task_active_state == 'archived' && runtimeArchivingOptions()): ?>

        <span class="label label-icons label-icons-default" data-toggle="tooltip" data-placement="top"

            title="<?php echo app('translator')->get('lang.archived'); ?>"><i class="ti-archive"></i></span>

        <?php endif; ?>

    </td>
    <td class="tasks_col_action actions_column">

        <!--action button-->

        <span class="list-table-action dropdown font-size-inherit">



            <!--[delete]-->

            <button type="button" title="<?php echo e(cleanLang(__('lang.delete'))); ?>"

                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"

                data-confirm-title="<?php echo e(cleanLang(__('lang.delete_item'))); ?>"

                data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="DELETE"

                data-url="<?php echo e(url('/')); ?>/tasks/<?php echo e($task->task_id); ?>">

                <i class="sl-icon-trash"></i>

            </button>


            <!--view-->

            <button type="button" title="<?php echo e(cleanLang(__('lang.view'))); ?>"

                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm show-modal-button reset-card-modal-form js-ajax-ux-request"

                data-toggle="modal" data-target="#cardModal" data-url="<?php echo e(urlResource('/tasks/'.$task->task_id)); ?>"

                data-loading-target="main-top-nav-bar">

                <i class="ti-new-window"></i>

            </button>

        </span>



        <!--more button (team)-->

        <?php if(auth()->user()->is_team && $task->permission_super_user): ?>

        <span class="list-table-action dropdown  font-size-inherit">

            <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"

                title="<?php echo e(cleanLang(__('lang.more'))); ?>"

                class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">

                <i class="ti-more"></i>

            </button>

            <div class="dropdown-menu" aria-labelledby="listTableAction">

                <!--record time-->

                <?php if($task->assigned_to_me): ?>

                <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"

                    data-confirm-title="<?php echo e(cleanLang(__('lang.archive_task'))); ?>" data-toggle="modal"

                    data-target="#commonModal" data-modal-title="<?php echo app('translator')->get('lang.record_your_work_time'); ?>"

                    data-url="<?php echo e(url('/timesheets/create?task_id='.$task->task_id)); ?>"

                    data-action-url="<?php echo e(urlResource('/timesheets')); ?>" data-modal-size="modal-sm"

                    data-loading-target="commonModalBody" data-action-method="POST" aria-expanded="false">

                    <?php echo e(cleanLang(__('lang.record_time'))); ?>


                </a>

                <?php endif; ?>

                <!--stop all timers-->

                <a class="dropdown-item confirm-action-danger"

                    data-confirm-title="<?php echo e(cleanLang(__('lang.stop_all_timers'))); ?>"

                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"

                    data-url="<?php echo e(url('/')); ?>/tasks/timer/<?php echo e($task->task_id); ?>/stopall?source=list">

                    <?php echo e(cleanLang(__('lang.stop_all_timers'))); ?>


                </a>

                <!--archive-->

                <?php if($task->task_active_state == 'active' && runtimeArchivingOptions()): ?>

                <a class="dropdown-item confirm-action-info"

                    data-confirm-title="<?php echo e(cleanLang(__('lang.archive_task'))); ?>"

                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"

                    data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/archive')); ?>">

                    <?php echo e(cleanLang(__('lang.archive'))); ?>


                </a>

                <?php endif; ?>

                <!--activate-->

                <?php if($task->task_active_state == 'archived' && runtimeArchivingOptions()): ?>

                <a class="dropdown-item confirm-action-info"

                    data-confirm-title="<?php echo e(cleanLang(__('lang.restore_task'))); ?>"

                    data-confirm-text="<?php echo e(cleanLang(__('lang.are_you_sure'))); ?>" data-ajax-type="PUT"

                    data-url="<?php echo e(urlResource('/tasks/'.$task->task_id.'/activate')); ?>">

                    <?php echo e(cleanLang(__('lang.restore'))); ?>


                </a>

                <?php endif; ?>



            </div>

        </span>

        <?php endif; ?>

        <!--more button-->

        <!--action button-->

    </td>

</tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!--each row--><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/pages/lead/components/task.blade.php ENDPATH**/ ?>