@foreach($tasks as $task)

<!--each row-->

<tr id="task_{{ $task->task_id }}" class="task-{{ $task->task_status }}">

    <td class="tasks_col_title td-edge">

        <!--for polling timers-->

        <input type="hidden" name="tasks[{{ $task->task_id }}]" value="{{ $task->assigned_to_me }}">

        <!--checkbox-->

        <span class="task_border td-edge-border {{ runtimeTaskStatusColors($task->task_status, 'background') }}"></span>

        <a class="show-modal-button reset-card-modal-form js-ajax-ux-request p-l-5" href="javascript:void(0)"

            data-toggle="modal" data-target="#cardModal" data-url="{{ urlResource('/tasks/'.$task->task_id) }}"

            data-loading-target="main-top-nav-bar"><span class="x-strike-through"

                id="table_task_title_{{ $task->task_id }}">

                {{ str_limit($task->task_title ?? '---', 45) }}</span></a>

    </td>
    <td class="tasks_col_deadline">{{ runtimeDate($task->task_date_due) }}</td>
    <td class="tasks_col_assigned" id="tasks_col_assigned_{{ $task->task_id }}">

        <!--assigned users-->

        @if(count($task->assigned) > 0)

        @foreach($task->assigned->take(2) as $user)

        <img src="{{ $user->avatar }}" data-toggle="tooltip" title="{{ $user->first_name }}" data-placement="top"

            alt="{{ $user->first_name }}" class="img-circle avatar-xsmall">

        @endforeach

        @else

        <span>---</span>

        @endif

        <!--assigned users-->

        <!--more users-->

        @if(count($task->assigned) > 2)

        @php $more_users_title = __('lang.assigned_users'); $users = $task->assigned; @endphp

        @include('misc.more-users')

        @endif

        <!--more users-->

    </td>
    <td class="tasks_col_status">

        <span

            class="label {{ runtimeTaskStatusColors($task->task_status, 'label') }}">{{ runtimeLang($task->task_status) }}</span>

        <!--archived-->

        @if($task->task_active_state == 'archived' && runtimeArchivingOptions())

        <span class="label label-icons label-icons-default" data-toggle="tooltip" data-placement="top"

            title="@lang('lang.archived')"><i class="ti-archive"></i></span>

        @endif

    </td>
    <td class="tasks_col_action actions_column">

        <!--action button-->

        <span class="list-table-action dropdown font-size-inherit">



            <!--[delete]-->

            <button type="button" title="{{ cleanLang(__('lang.delete')) }}"

                class="data-toggle-action-tooltip btn btn-outline-danger btn-circle btn-sm confirm-action-danger"

                data-confirm-title="{{ cleanLang(__('lang.delete_item')) }}"

                data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="DELETE"

                data-url="{{ url('/') }}/tasks/{{ $task->task_id }}">

                <i class="sl-icon-trash"></i>

            </button>


            <!--view-->

            <button type="button" title="{{ cleanLang(__('lang.view')) }}"

                class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm show-modal-button reset-card-modal-form js-ajax-ux-request"

                data-toggle="modal" data-target="#cardModal" data-url="{{ urlResource('/tasks/'.$task->task_id) }}"

                data-loading-target="main-top-nav-bar">

                <i class="ti-new-window"></i>

            </button>

        </span>



        <!--more button (team)-->

        @if(auth()->user()->is_team && $task->permission_super_user)

        <span class="list-table-action dropdown  font-size-inherit">

            <button type="button" id="listTableAction" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"

                title="{{ cleanLang(__('lang.more')) }}"

                class="data-toggle-action-tooltip btn btn-outline-default-light btn-circle btn-sm">

                <i class="ti-more"></i>

            </button>

            <div class="dropdown-menu" aria-labelledby="listTableAction">

                <!--record time-->

                @if($task->assigned_to_me)

                <a class="dropdown-item edit-add-modal-button js-ajax-ux-request reset-target-modal-form"

                    data-confirm-title="{{ cleanLang(__('lang.archive_task')) }}" data-toggle="modal"

                    data-target="#commonModal" data-modal-title="@lang('lang.record_your_work_time')"

                    data-url="{{ url('/timesheets/create?task_id='.$task->task_id) }}"

                    data-action-url="{{ urlResource('/timesheets') }}" data-modal-size="modal-sm"

                    data-loading-target="commonModalBody" data-action-method="POST" aria-expanded="false">

                    {{ cleanLang(__('lang.record_time')) }}

                </a>

                @endif

                <!--stop all timers-->

                <a class="dropdown-item confirm-action-danger"

                    data-confirm-title="{{ cleanLang(__('lang.stop_all_timers')) }}"

                    data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="PUT"

                    data-url="{{ url('/') }}/tasks/timer/{{ $task->task_id }}/stopall?source=list">

                    {{ cleanLang(__('lang.stop_all_timers')) }}

                </a>

                <!--archive-->

                @if($task->task_active_state == 'active' && runtimeArchivingOptions())

                <a class="dropdown-item confirm-action-info"

                    data-confirm-title="{{ cleanLang(__('lang.archive_task')) }}"

                    data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="PUT"

                    data-url="{{ urlResource('/tasks/'.$task->task_id.'/archive') }}">

                    {{ cleanLang(__('lang.archive')) }}

                </a>

                @endif

                <!--activate-->

                @if($task->task_active_state == 'archived' && runtimeArchivingOptions())

                <a class="dropdown-item confirm-action-info"

                    data-confirm-title="{{ cleanLang(__('lang.restore_task')) }}"

                    data-confirm-text="{{ cleanLang(__('lang.are_you_sure')) }}" data-ajax-type="PUT"

                    data-url="{{ urlResource('/tasks/'.$task->task_id.'/activate') }}">

                    {{ cleanLang(__('lang.restore')) }}

                </a>

                @endif



            </div>

        </span>

        @endif

        <!--more button-->

        <!--action button-->

    </td>

</tr>

@endforeach

<!--each row-->