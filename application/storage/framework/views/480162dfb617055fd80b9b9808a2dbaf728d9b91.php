<div id="replace_mm"><div class="row m-l-50">		<div class="form-group col-sm-10 form-input-employee" style="padding-right:0;">			<h2 class="categories-employee">Meetings</h2>		</div>			<div class="col-sm-2" id="add_mminutes">				 <button type="button" class="btn btn-success-2">				 					<i class="ti-plus"></i>				</button>			</div>		</div>		<div class="list_dr"><?php if(!$meeting_minutes->isEmpty()): ?> <table class="table table-dr m-b-0 m-l-50">    <tbody>	<?php $__currentLoopData = $meeting_minutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	        <tr class="view_detail">            <td class="p-l-10 p-t-30" style="width:10%;"><?php echo e(runtimeDate($dr->meetingminutes_created)); ?></td>            <td class="font-medium p-r-0 p-t-30">                <?php echo e($dr->meetingminutes_title); ?>                                </td>						<td class="p-r-0 p-t-30">				<button type="button" title="<?php echo e(cleanLang(__('lang.edit'))); ?>" class="data-toggle-action-tooltip btn btn-outline-success btn-circle btn-sm edit-dr" id="<?php echo e($dr->meetingminutes_id .'Þ'.$dr->meetingminutes_title.'Þ'.$dr->meetingminutes_description); ?>">					<i class="sl-icon-note"></i>				</button>         				<button type="button" title="Detail" class="data-toggle-action-tooltip btn btn-outline-warning btn-circle btn-sm view-dr m-r-5" id="<?php echo e($dr->meetingminutes_id .'Þ'.$dr->meetingminutes_title.'Þ'.$dr->meetingminutes_description.'Þ'); ?>">					<i class="sl-icon-eye"></i>				</button>                 </td>        </tr>						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>				                  	</tbody></table> <?php else: ?>            <!--nothing found-->    <?php echo $__env->make('notifications.no-results-found', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>            <!--nothing found--><?php endif; ?></div><form id="form_mm" class="hide" method="post">			<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">Meetings title</p>			<textarea class="form-control" id="meetingminutes_title" name="meetingminutes_title" rows="4"></textarea>			<input type="hidden" id="meetingminutes_id" name="meetingminutes_id" value="">		</div>		</div>		<div class="row m-t-50 p-l-50">		<div class="form-group col-sm-10 form-input-employee">			<p class="p-l-10 font-dr">Meetings minutes</p>			<textarea class="form-control" id="meetingminutes_description" name="meetingminutes_description" rows="30"></textarea>		</div>		</div>			<div class="row m-t-20 p-l-50">		<div class="col-sm-10 form-input-employee">			<button type="submit" class="btn btn-rounded-x btn-dr waves-effect" data-on-start-submit-button="disable">Submit</button>		</div>						</div></form>    <!--page content --><script>var id = "<?php echo e(isset($users->id) ? '/' .$users->id : ''); ?>";var url = "<?php echo e($page['action_url']); ?>"+id;$("form#form_mm").submit(function(e) {		var obj = {};		var csrf_token = "<?php echo e(csrf_token()); ?>";	e.preventDefault();		var formData = new FormData(this);		$.ajaxSetup({		headers: {			'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>"		}	});	$.ajax({		url: url,		type: 'POST',		data: formData,		success: function (response) {			//var returnedData = JSON.parse(response);			var notification = response['notification'];			obj['type'] = notification['type'];			obj['message'] = notification['value'];						NX.notification(obj);			if(obj['type'] == 'success'){				var dom_html = response['dom_html'][0];				$("#replace_mm").replaceWith(dom_html['value']);				}					},		cache: false,		contentType: false,		processData: false	});});$('#add_mminutes').click(function(){	$('#meetingminutes_id').val('');	$('.list_dr').addClass('hide');	$('#add_mminutes').addClass('hide');	$('#form_mm').removeClass('hide');		});$('.edit-dr').click(function(){	$('.list_dr').addClass('hide');	$('#add_mminutes').addClass('hide');	$('#form_mm').removeClass('hide');	var val = $(this).get(0).id;	var dt = val.split('Þ');	$('#meetingminutes_id').val(dt[0]);	$('#meetingminutes_title').val(dt[1]);	$('#meetingminutes_description').val(dt[2]);});$('.view-dr').click(function(){	$('.list_dr').addClass('hide');	$('#add_mminutes').addClass('hide');	$('#form_mm').removeClass('hide');	var val = $(this).get(0).id;	var dt = val.split('Þ');			$('#meetingminutes_id').val(dt[0]);	$('#meetingminutes_title').val(dt[1]);	$('#meetingminutes_description').val(dt[2]);		$('#meetingminutes_title').attr("disabled", true);	$('#meetingminutes_description').attr("disabled", true);		$('.btn-dr').attr("disabled", true);	});</script></div><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/pages/employee/form/meeting-minutes.blade.php ENDPATH**/ ?>