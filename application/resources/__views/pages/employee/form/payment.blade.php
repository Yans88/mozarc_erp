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
                    <input type="text"  class="form-control" >
                </div>
                <div>
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
                    data-toggle="modal" data-target="#commonModal" data-url="{{ _url('/groups/create') }}" 

                    data-loading-target="commonModalBody" data-modal-title="{{ $page['add_modal_title'] ?? '' }}"

                    data-action-url="{{ _url('/groups') }}"

                    data-action-method="POST"

                    data-action-ajax-class="{{ $page['add_modal_action_ajax_class'] ?? '' }}"

                    data-modal-size="{{ $page['add_modal_size'] ?? '' }}"

                    data-action-ajax-loading-target="{{ $page['add_modal_action_ajax_loading_target'] ?? '' }}"

                    data-save-button-class="{{ $page['add_modal_save_button_class'] ?? '' }}" data-project-progress="0">
                    
					<i class="ti-plus"></i>
				</button>
			</div>
        </div>

        @for($i=0; $i < 4; $i++)
            @php
                $color = $i == 0 ? 'red' : 'green';
            @endphp
        
        <div class="card"  style="border-right:2vw solid {{$color}};">
            <div class="card-body  ">
                <table style="width:100%">
                    <tr>
                        <td>xxxx-xx-xx</td>
                        <td>Title of Payment</td>
                        <td>Paid Amount</td>
                        <td>
                            <label >Comment</label>
                            <br>
                            <textarea name="" id="" rows="1"  style="width:100%"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        @endfor
    </section>
    


    <!--page content -->


</div>
