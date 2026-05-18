<?php

namespace App\Models\Master;

use App\Models\Products;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryMaster extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_image',
        'category_description',
        'slug',
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategoryMaster::class, 'category_id');
    }

    // CategoryMaster.php
    public function products()
    {
        return $this->hasMany(Products::class, 'category_id');
    }

}
