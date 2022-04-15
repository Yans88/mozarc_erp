<div id="replace_dr">


    <section class="col-sm-12" style="padding-left: 10%;">
        <div class="row ">
            <div class="form-group col-sm-10">
                <h2 class="categories-employee">Salary</h2>
                
                    
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group ">
                <div>
                    <label>Basic Salary</label>
                    <input type="text"  class="form-control">
                </div>
                <div class="mt-2">
                    <label>Hourly Rate</label>
                    <input type="text" class="form-control" >
                </div>
                
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8 form-group">
                <label>Others</label>
                <br>
                <textarea name="" id=""  rows="3" style="width:100%"></textarea>
            </div>
        </div>

    </section>

    <section class="col-sm-12 mt-5" style="padding-left: 10%;">
        <div class="row ">
            <div class="form-group col-sm-2 " >
                <h2 class="categories-employee">Payment History</h2>
            </div>
            <div class="col-sm-2" id="add_dr">
				 <button type="button" 
                    class="btn btn-success-2"
                    data-toggle="modal" data-target="#add_payment_history_modal" >
                    
					<i class="ti-plus"></i>
				</button>
			</div>
        </div>

        @if(!$employee_payments->isEmpty())
            @foreach($employee_payments as $payment)
                @php
                    $color = $payment->status === 1 ? 'green' : 'red';
                @endphp
            <div class="card"  style="border-right:2vw solid {{$color}};">
                <div class="card-body  ">
                    <table style="width:100%; table-layout:fixed;">
                        <tr>
                            <td>{{$payment->paid_date}}</td>
                            <td>{{$payment->payment_title}}</td>
                            <td>{{$payment->paid_amount}}</td>
                            <td style="width:40%;">
                                <label >Comment</label>
                                <br>
                                <textarea rows="1"  style="width:100%">{{$payment->comment}}</textarea>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            @endforeach

        @else
                    <!--nothing found-->

            @include('notifications.no-results-found')
                    <!--nothing found-->

        @endif


    </section>
    


    <!--page content -->

    <!--modal-->

    <div class="modal" role="dialog" aria-labelledby="foo" id="add_payment_history_modal" {!! clean(runtimeAllowCloseModalOptions()) !!}>

        <div class="modal-dialog">

            <form id="add_payment" action="{{url('employee/save_payment')}}" method="post" class="form-horizontal">
                @csrf
                <div class="modal-content">

                    <div class="modal-header" >

                        <h4 class="modal-title" ></h4>

                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"

                            id="commonModalCloseIcon">

                            <i class="ti-close"></i>

                        </button>

                    </div>

                    
                    <div class="modal-body min-h-200 pt-0" >
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    @if($users && $users->employee_id)
                                    <input type="text" name="employee_id" value="{{$users->employee_id}}" hidden>
                                    @endif
                                    <div>
                                        <label>Paid Date</label>
                                        <input type="text" name="paid_date"  class="form-control" >
                                    </div>
                                    <div class="mt-2">
                                        <label>Payment Title</label>
                                        <input type="text" name="payment_title"  class="form-control" >
                                    </div>
                                    <div class="mt-2">
                                        <label>Paid Amount</label>
                                        <input type="number" name="paid_amount" class="form-control" >
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-sm-6"></div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Comment</label>
                                    <br>
                                    <textarea name="comment"   rows="3" style="width:100%"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-rounded-x btn-secondary waves-effect text-left" data-dismiss="modal">{{ cleanLang(__('lang.close')) }}</button>

                        <button type="submit" 

                            class="btn btn-rounded-x btn-danger waves-effect text-left" data-url="" data-loading-target=""

                            data-ajax-type="POST" data-on-start-submit-button="disable">{{ cleanLang(__('lang.submit')) }}</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

    <!--notes: see events.js for deails-->

   <script>
       $('form#add_payment').submit(function(e){
           e.preventDefault();
           var obj = {}

           var formData = new FormData(this);	
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                }
            });
            

            $.ajax({
                url: '{{url("employee/save_payment")}}',
                type: 'POST',
                data: formData,
                dataType: 'JSON',
                success: function(response){
                    console.log(response)
                    var notification = response['notification'];
                    obj['type'] = notification['type'];
                    obj['message'] = notification['value'];
                    console.log(obj)
                    NX.notification(obj);
                    if(obj['type'] == 'success'){
                        $('#add_payment_history_modal').modal('hide');
                        var dom_html = response['dom_html'][0];
				        $("#replace_dr").replaceWith(dom_html['value']);	
                    }

                    
                },
                cache: false,
                contentType: false,
                processData: false
            })

            
           
       })

        
        

   </script>

</div>
