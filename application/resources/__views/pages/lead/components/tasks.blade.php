<div class="card-task" id="card-task">

    <div class="x-heading clearfix">
        <i class="ti-menu-alt"></i>{{ cleanLang(__('lang.task')) }}
    </div>

    <table id="tasks-list-table" class="table m-t-0 m-b-0 table-hover no-wrap contact-list" data-page-size="10"

        data-url="{{ url('/') }}/tasks/timer-poll/" data-type="form" data-ajax-type="post"

        data-form-id="tasks-list-table">

        <thead>

            <tr>

                <th class="tasks_col_title">

                    <a class="js-ajax-ux-request js-list-sorting" id="sort_task_title" href="javascript:void(0)"

                        data-url="{{ urlResource('/tasks?action=sort&orderby=task_title&sortorder=asc') }}">{{ cleanLang(__('lang.title')) }}<span

                            class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>

                </th>

                <th class="tasks_col_deadline">

                    <a class="js-ajax-ux-request js-list-sorting" id="sort_task_date_due"

                        href="javascript:void(0)"

                        data-url="{{ urlResource('/tasks?action=sort&orderby=task_date_due&sortorder=asc') }}">{{ cleanLang(__('lang.deadline')) }}<span

                            class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>

                </th>

                <th class="tasks_col_assigned"><a href="javascript:void(0)">{{ cleanLang(__('lang.assigned')) }}</a></th>

                <th class="tasks_col_status">

                    <a class="js-ajax-ux-request js-list-sorting" id="sort_task_status"

                        href="javascript:void(0)"

                        data-url="{{ urlResource('/tasks?action=sort&orderby=task_status&sortorder=asc') }}">{{ cleanLang(__('lang.status')) }}<span

                            class="sorting-icons"><i class="ti-arrows-vertical"></i></span></a>

                </th>

                <th class="tasks_col_action"><a href="javascript:void(0)">{{ cleanLang(__('lang.action')) }}</a></th>

            </tr>

        </thead>

        <tbody id="card-tasks-container">
            <!--dynamic content here-->
        </tbody>

        <tfoot>

            <tr>

                <td colspan="20">

                    <!--load more button-->

                    @include('misc.load-more-button')

                    <!--load more button-->

                </td>

            </tr>

        </tfoot>

    </table>

    @if($lead->permission_edit_lead)

    <div class="x-action">

        <a href="javascript:void(0)" class="js-card-task-toggle" id="card-task-add-new">Add new task</a>

    </div>

    @endif

</div>
<br />
<br />
<br />

<script>
localStorage.removeItem("lead_id_task");
localStorage.removeItem("lead_title_task");
$('#card-task-add-new').click(function(){
	var lead_title = "{{ $lead->lead_title }}";
	var lead_id = "{{ $lead->lead_id }}";
	$('.modal').modal('hide');
	$('#btn-add-task').click();
	localStorage.setItem("lead_id_task", lead_id);
	localStorage.setItem("lead_title_task", lead_title);
});
</script>