<!--ALL THIRD PART JAVASCRIPTS-->
<script src="mozarc_work/public/vendor/js/vendor.footer.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--nextloop.core.js-->
<script src="mozarc_work/public/js/core/ajax.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--MAIN JS - AT END-->
<script src="mozarc_work/public/js/core/boot.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--EVENTS-->
<script src="mozarc_work/public/js/core/events.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--CORE-->
<script src="mozarc_work/public/js/core/app.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--BILLING-->
<script src="mozarc_work/public/js/core/billing.js?v=<?php echo e(config('system.versioning')); ?>"></script>

<!--project page charts-->
<?php if(@config('visibility.projects_d3_vendor')): ?>
<script src="mozarc_work/public/vendor/js/d3/d3.min.js?v=<?php echo e(config('system.versioning')); ?>"></script>
<script src="mozarc_work/public/vendor/js/c3-master/c3.min.js?v=<?php echo e(config('system.versioning')); ?>"></script>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\mozarc_work\application\resources\views/layout/footerjs.blade.php ENDPATH**/ ?>