 <?php $__env->startSection('content'); ?>
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

       


        <!-- action buttons -->
        <?php echo $__env->make('pages.employee.files.components.misc.list-page-actions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--files table-->			
            <?php echo $__env->make('pages.employee.files.components.table.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!--files table-->
        </div>
    </div>
    <!--page content -->
</div>
<!--main content -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.wrapper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/pages/employee/files/wrapper.blade.php ENDPATH**/ ?>