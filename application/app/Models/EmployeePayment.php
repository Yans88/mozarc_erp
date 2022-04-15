<?php



namespace App\Models;



use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\Storage;

use Cache;


class EmployeePayment extends Authenticatable {

    protected $table = 'employee_payment';
	
    protected $primaryKey = 'payment_id';

    protected $dateFormat = 'Y-m-d H:i:s';   


}