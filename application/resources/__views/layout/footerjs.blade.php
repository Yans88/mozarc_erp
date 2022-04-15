<!--ALL THIRD PART JAVASCRIPTS-->
<script src="mozarc_work/public/vendor/js/vendor.footer.js?v={{ config('system.versioning') }}"></script>

<!--nextloop.core.js-->
<script src="mozarc_work/public/js/core/ajax.js?v={{ config('system.versioning') }}"></script>

<!--MAIN JS - AT END-->
<script src="mozarc_work/public/js/core/boot.js?v={{ config('system.versioning') }}"></script>

<!--EVENTS-->
<script src="mozarc_work/public/js/core/events.js?v={{ config('system.versioning') }}"></script>

<!--CORE-->
<script src="mozarc_work/public/js/core/app.js?v={{ config('system.versioning') }}"></script>

<!--BILLING-->
<script src="mozarc_work/public/js/core/billing.js?v={{ config('system.versioning') }}"></script>

<!--project page charts-->
@if(@config('visibility.projects_d3_vendor'))
<script src="mozarc_work/public/vendor/js/d3/d3.min.js?v={{ config('system.versioning') }}"></script>
<script src="mozarc_work/public/vendor/js/c3-master/c3.min.js?v={{ config('system.versioning') }}"></script>
@endif