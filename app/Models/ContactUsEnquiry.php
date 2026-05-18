<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsEnquiry extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'name',
        'email',
        'mobile',
        'subject',
        'message',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
