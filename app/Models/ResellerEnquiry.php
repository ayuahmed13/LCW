<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResellerEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'name',
        'email',
        'mobile',
        'abn',
        'company_trade_name',
        'message',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
