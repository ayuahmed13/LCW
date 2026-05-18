<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductParameterValueMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_parameter_id',
        'product_parameter_value',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];

    public function parameter()
    {
        return $this->belongsTo(ProductParameterMaster::class, 'product_parameter_id');
    }
    

}
