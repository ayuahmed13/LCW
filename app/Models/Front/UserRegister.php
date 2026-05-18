<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class UserRegister extends User
{
    use HasFactory;
 protected $guard='master_users';
    protected $fillable = [
        'first_name',
        'last_name',
        'full_name',
        'customer_id',
        'email',
        'phone_no',
        'company_name',
        'address',
        'city',
        'street',
        'appartment',
        'pincode',
        'password',
        'user_timezone',
        
        'otp',
        'is_otp_verified',
        'otp_verified_at',
        'last_login',
        'is_logged_in',
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
