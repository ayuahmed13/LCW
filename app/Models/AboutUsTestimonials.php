<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsTestimonials extends Model
{
    use HasFactory;

    protected $fillable = [
       
        'heading',
        'name',
        'description',
        'star_rating',

        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
