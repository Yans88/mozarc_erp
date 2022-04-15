@extends('layout.wrapper') @section('content')
<!-- main content -->
<div class="container-fluid">

    <!--page heading-->
    <div class="row page-titles">

       


        <!-- action buttons -->
        @include('pages.employee.files.components.misc.list-page-actions')
        <!-- action buttons -->

    </div>
    <!--page heading-->

    <!-- page content -->
    <div class="row">
        <div class="col-12">
            <!--files table-->			
            @include('pages.employee.files.components.table.wrapper')
            <!--files table-->
        </div>
    </div>
    <!--page content -->
</div>
<!--main content -->
@endsection