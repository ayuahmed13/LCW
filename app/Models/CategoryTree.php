<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTree extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
    ];

    public function subcategories()
    {
        return $this->hasMany(CategoryTree::class, 'parent_id');
    }

    // A CategoryTree can have one parent CategoryTree
    public function parent()
    {
        return $this->belongsTo(CategoryTree::class, 'parent_id');
    }
}
