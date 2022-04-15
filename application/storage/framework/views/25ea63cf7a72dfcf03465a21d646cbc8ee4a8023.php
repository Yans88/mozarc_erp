<div id="replace_dr"><div class="row m-l-50">		<div class="form-group col-sm-10 form-input-employee" style="padding-right:0;">			<h2 class="categories-employee">Daily report</h2>		</div>			<div class="col-sm-2" id="add_dr">				 <button type="button" class="btn btn-success-2">				 					<i class="ti-plus"></i>				</button>			</div>		</div>		<div class="list_dr"><?php if(!$daily_reports->isEmpty()): ?> <table class="table table-dr m-b-0 m-l-50">    <tbody>	<?php $__currentLoopData = $daily_reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	        <tr class="view_detail">            <td class="p-l-10 p-t-30" style="width:10%;"><?php echo e(runtimeDate($dr->dailyreport_created)); ?></td>            <td class="font-medium p-r-0 p-t-30">                <div class="white-box"><?php echo e($dr->your_day_general); ?></div>                                       </td>						<td class="p-r-0 p-t-30">				<button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>" class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-dr" id="<?php echo e($dr->dailyreport_id.'Þ'.$dr->your_day_general.'Þ'.$dr->your_schedules.'Þ'.$dr->your_task_description.'Þ'.$dr->you_feel_good_today.'Þ'.$dr->you_learned_today.'Þ'.$dr->any_issues_today.'Þ'.$dr->you_willdo_bebetter.'Þ'.$dr->overall_comment.'Þ'.$dr->your_goal_today); ?>">					<i class="sl-icon-note"></i>				</button>         				<button type="button" title="Detail" class="data-toggle-action-tooltip btn btn-outline-warning btn-circle btn-sm view-dr m-r-5" id="<?php echo e($dr->dailyreport_id.'Þ'.$dr->your_day_general.'Þ'.$dr->your_schedules.'Þ'.$dr->your_task_description.'Þ'.$dr->you_feel_good_today.'Þ'.$dr->you_learned_today.'Þ'.$dr->any_issues_today.'Þ'.$dr->you_willdo_bebetter.'Þ'.$dr->overall_comment.'Þ'.$dr->your_goal_today.'Þ'); ?>">					<i class="sl-icon-eye"></i>				</button>                 </td>        </tr>						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				                  	</tbody></table> <?php else: ?>            <!--nothing found-->    <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>            <!--nothing found--><?php endif; ?></div><form id="form_dr" class="hide" method="post">    <div class="row m-t-20 p-l-50 form-group col-sm-10 form-input-employee">		<p class="p-l-10 font-dr">How was your day in General</p>			</div>	<div class="row m-t-20 m-l-0 form-group col-sm-4 white-box2-add">				<div class="white-box2 m-r-20 box-input-dr form-input-employee " id="daydr1">1</div>   				<div class="white-box2 m-r-20 box-input-dr" id="daydr2">2</div>   				<div class="white-box2 m-r-20 box-input-dr" id="daydr3">3</div>   				<div class="white-box2 m-r-20 box-input-dr" id="daydr4">4</div>   				<div class="white-box2 box-input-dr" id="daydr5">5</div>   			<input type="hidden" id="your_day_general" name="your_day_general" value="">		<input type="hidden" id="dailyreport_id" name="dailyreport_id" value="">	</div>		<div class="row m-t-20 m-l-0 form-group col-sm-4 white-box2-view">				<div class="m-r-20 form-input-employee white-box2-disabled" id="daydr_1">1</div>   				<div class="m-r-20 white-box2-disabled" id="daydr_2">2</div>   				<div class="m-r-20 white-box2-disabled" id="daydr_3">3</div>   				<div class="m-r-20 white-box2-disabled" id="daydr_4">4</div>   				<div class="white-box2-disabled" id="daydr_5">5</div>   				</div>				<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">Your goal Today</p>			<textarea class="form-control" id="your_goal_today" name="your_goal_today" rows="8"></textarea>		</div>		</div>		<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">Your Schedules</p>			<textarea class="form-control" id="your_schedules" name="your_schedules" rows="15"></textarea>		</div>		</div>		<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">Your task description</p>			<textarea class="form-control" id="your_task_description" name="your_task_description" rows="12"></textarea>		</div>		</div>		<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">How do you feel you did good today</p>			<textarea class="form-control" id="you_feel_good_today" name="you_feel_good_today" rows="10"></textarea>		</div>		</div>		<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">What you have learned today</p>			<textarea class="form-control" id="you_learned_today" name="you_learned_today" rows="10"></textarea>		</div>		</div>		<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">Any issues or difficulties you faced today</p>			<textarea class="form-control" id="any_issues_today" name="any_issues_today" rows="10"></textarea>		</div>		</div>		<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">What you will do to be better</p>			<textarea class="form-control" id="you_willdo_bebetter" name="you_willdo_bebetter" rows="10"></textarea>		</div>		</div>		<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">Overall comment</p>			<textarea class="form-control" id="overall_comment" name="overall_comment" rows="10"></textarea>		</div>		</div>		<div class="row m-t-20 p-l-50">		<div class="col-sm-10 form-input-employee">			<button type="submit" class="btn btn-rounded-x btn-dr waves-effect" data-on-start-submit-button="disable">Submit</button>		</div>						</div></form>    <!--page content --><script>var id = "<?php echo e(isset($users->id) ? '/' .$users->id : ''); ?>";var url = "<?php echo e($page['action_url']); ?>"+id;$("form#form_dr").submit(function(e) {		var obj = {};		var csrf_token = "<?php echo e(csrf_token()); ?>";	e.preventDefault();		var formData = new FormData(this);		$.ajaxSetup({		headers: {			'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"		}	});	$.ajax({		url: url,		type: 'POST',		data: formData,		success: function (response) {			//var returnedData = JSON.parse(response);			var notification = response['notification'];			obj['type'] = notification['type'];			obj['message'] = notification['value'];						NX.notification(obj);			if(obj['type'] == 'success'){				var dom_html = response['dom_html'][0];				$("#replace_dr").replaceWith(dom_html['value']);				}					},		cache: false,		contentType: false,		processData: false	});});$('#add_dr').click(function(){	$('#dailyreport_id').val('');	$('.list_dr').addClass('hide');	$('#add_dr').addClass('hide');	$('#form_dr').removeClass('hide');	$('.white-box2-add').show();	$('.white-box2-view').hide();	});$('.edit-dr').click(function(){	$('.list_dr').addClass('hide');	$('#add_dr').addClass('hide');	$('#form_dr').removeClass('hide');	var val = $(this).get(0).id;	var dt = val.split('Þ');	$('#daydr'+dt[1]).addClass('white-box2-active');	$('#dailyreport_id').val(dt[0]);	$('#your_day_general').val(dt[1]);	$('#your_schedules').val(dt[2]);	$('#your_task_description').val(dt[3]);	$('#you_feel_good_today').val(dt[4]);	$('#you_learned_today').val(dt[5]);	$('#any_issues_today').val(dt[6]);	$('#you_willdo_bebetter').val(dt[7]);	$('#overall_comment').val(dt[8]);	$('#your_goal_today').val(dt[9]);		$('.white-box2-add').show();	$('.white-box2-view').hide();});$('.view-dr').click(function(){	$('.list_dr').addClass('hide');	$('#add_dr').addClass('hide');	$('#form_dr').removeClass('hide');	var val = $(this).get(0).id;	var dt = val.split('Þ');	$('#daydr_'+dt[1]).addClass('white-box2-active');		$('.white-box2-add').hide();	$('.white-box2-view').show();		$('#dailyreport_id').val(dt[0]);	$('#your_day_general').val(dt[1]);	$('#your_schedules').val(dt[2]);	$('#your_task_description').val(dt[3]);	$('#you_feel_good_today').val(dt[4]);	$('#you_learned_today').val(dt[5]);	$('#any_issues_today').val(dt[6]);	$('#you_willdo_bebetter').val(dt[7]);	$('#overall_comment').val(dt[8]);	$('#your_goal_today').val(dt[9]);	$('#your_day_generalr').attr("disabled", true);	$('#your_schedules').attr("disabled", true);	$('#your_task_description').attr("disabled", true);	$('#you_feel_good_today').attr("disabled", true);	$('#you_learned_today').attr("disabled", true);	$('#any_issues_today').attr("disabled", true);	$('#you_willdo_bebetter').attr("disabled", true);	$('#overall_comment').attr("disabled", true);	$('#your_goal_today').attr("disabled", true);	$('.btn-dr').attr("disabled", true);	});$('.box-input-dr').click(function() {	$('.white-box2').removeClass('white-box2-active');	$('#'+this.id).addClass('white-box2-active');	$('#your_day_general').val(this.id.replace("daydr", ""));});</script></div><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/pages/employee/form/dr.blade.php ENDPATH**/ ?>