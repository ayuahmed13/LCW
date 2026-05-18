<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductParameterMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_parameter_name',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];

    public function values()
    {
        return $this->hasMany(ProductParameterValueMaster::class, 'product_parameter_id');
    }
    
}
