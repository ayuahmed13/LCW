<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsParameterData extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'parameter_name_id',
        'parameter_value_id',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
