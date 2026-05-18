<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsPdfFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_pdf_file_name',
        'product_pdf_file',
        
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
