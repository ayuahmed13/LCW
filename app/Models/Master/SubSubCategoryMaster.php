<?php

namespace App\Models\Master;

use App\Models\Products;
use App\Models\Master\CategoryMaster;
use Illuminate\Database\Eloquent\Model;
use App\Models\Master\SubCategoryMaster;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubSubCategoryMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'sub_sub_category_name',
        'sub_sub_category_image',
        'slug',
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategoryMaster::class, 'sub_category_id');
    }
    
    public function category()
    {
        return $this->belongsTo(CategoryMaster::class, 'category_id');
    }

    // SubSubCategoryMaster.php
    public function products()
    {
        return $this->hasMany(Products::class, 'sub_sub_category_id');
    }
}
