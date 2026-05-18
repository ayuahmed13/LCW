<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsDescriptionImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_discription_name',
        'product_discription_image',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
