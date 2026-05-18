<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsCms extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'heading',
        'about_lcw',
        'our_vision',
        'our_mission',
        'image',

        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
