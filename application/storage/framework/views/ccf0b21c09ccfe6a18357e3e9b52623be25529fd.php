 <?php $__env->startSection('content'); ?><!-- main content --><div class="container-fluid">       <!-- page content -->    <div class="row">        <!--left panel-->                 <!--left panel-->        <!-- Column -->        <div class="col-12">				            <div class="room-card h-100">				<div class="row">					                <!--top nav-->											<?php echo $__env->make('pages.rooms.form.topnav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>											<!-- main content -->						<div class="tab-content">							<div class="tab-pane active ext-ajax-container" id="clients_ajaxtab" role="tabpanel">								<div class="card-body tab-body tab-body-embedded" id="embed-content-container">									<!--dynamic content here-->																	</div>							</div>						</div>											</div>							</div>        </div>        <!-- Column -->    </div>    <!--page content --></div><!--main content --><span class="hidden" id="dynamic-client-content" class="js-ajax-ux-request"  data-url="<?php echo e($page['dynamic_url'] ?? ''); ?>" data-loading-target="embed-content-container">placeholder</span><?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/pages/rooms/wrapper.blade.php ENDPATH**/ ?>