<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'sub_sub_category_id',
        'brand_id',
        
        'product_name',
        'product_id',
        'slug_url',
        'product_main_image',

        // 'gallery_images',
        // 'download_file',
        // 'description_image',

        'sku',
        'price',
        'offer_price',

        'is_gst',
        'gst_id',

        'description',
        'specification',

        // 'is_voltage',
        // 'voltage_id',
        
        // 'is_wattage',
        // 'wattage_id',
        
        // 'is_iprate',
        // 'iprate_id',
        
        'current_stock',
        'stock_remark',
        'is_available',
       
        'meta_title',
        'meta_keywords',
        'meta_description',
       
        'extra_tab',
        'tab_name',
        'controller_product_ids',
        'short_description',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];

    
    public function parameterData()
    {
        return $this->hasMany(ProductsParameterData::class, 'product_id');
    }
}
