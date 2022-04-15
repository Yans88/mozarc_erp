<?php



/** --------------------------------------------------------------------------------

 * This repository class manages all the data absctration for units

 *

 * @package    Grow CRM

 * @author     NextLoop

 *----------------------------------------------------------------------------------*/



namespace App\Repositories;



use App\Models\EmployeePayment;

use Illuminate\Http\Request;

use Log;


class  EmployeePaymentRepository{


    public function search($id = null){


        if($id){
            $payment = EmployeePayment::where('payment_id', $id);
        }else{
            $payment = EmployeePayment::select('*');
        }

        if(request()->has('employee_id')){
            $payment->where('employee_id', request('employee_id'));
        }
        else{
            $payment->where('employee_id', 0);
        }

        $payment->orderBy('created_at', 'desc');

        return $payment->paginate(config('system.settings_system_pagination_limits'));
    }


    public function create(){

        $payment = new EmployeePayment();
        $payment->employee_id = request('employee_id');
        $payment->paid_date = request('paid_date');  
        $payment->payment_title = request('payment_title');  
        $payment->paid_amount = request('paid_amount');  
        $payment->comment = request('comment');  
        $payment->created_by = auth()->id();

        //save and return id

        if ($payment->save()) {

            return $payment->payment_id;

        } else {

            return false;

        }



    }


}