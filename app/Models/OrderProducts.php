<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;

     protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_main_image',
        'product_price',
        'product_offer_price',
        'product_qty',
        'product_tax_per',
        'product_tax_amount',
        'sub_total_without_tax',
        'sub_total_with_tax',
        'product_total_amount',
      
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];
}
