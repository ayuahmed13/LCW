<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'address_heading',
        'name',
        'email',
        'phone',
        'state',
        'country',
        'company',
        'address',
        'city',
        'street',
        'appartment',
        'pincode',
        'is_default',
        
        'country_id','state_id','city_id',

        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
