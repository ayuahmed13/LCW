<?php

namespace App\Models\Master;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategoryMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_name',
        'sub_category_image',
        'sub_category_description',
        'slug',
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryMaster::class, 'category_id');
    }

    public function subSubCategories()
    {
        return $this->hasMany(SubSubCategoryMaster::class, 'sub_category_id');
    }

   // SubCategoryMaster.php
    public function products()
    {
        return $this->hasMany(Products::class, 'sub_category_id');
    }
}
