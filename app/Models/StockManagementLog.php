<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockManagementLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'current_stock',
        'stock_remark',
        'stock_data_id',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
