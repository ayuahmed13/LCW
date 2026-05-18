<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllCategories extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_image',
        'category_description',
        'slug',
        'parent_category_id',
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
