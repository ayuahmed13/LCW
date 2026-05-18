<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsSpecifications extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_parameter_id',
        'product_parameter_value',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
