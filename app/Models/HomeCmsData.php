<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeCmsData extends Model
{
    use HasFactory;

    protected $fillable = [
        'section1_heading1',
        'section1_sub_heading1',
        'section1_button_name1',
        'section1_button_url1',
        'section1_image1',
        'section1_heading2',
        'section1_sub_heading2',
        'section1_button_name2',
        'section1_button_url2',
        'section1_image2',
        'section1_heading3',
        'section1_sub_heading3',
        'section1_button_name3',
        'section1_button_url3',
        'section1_image3',
        'section2_marquee_text',
        'section3_heading1',
        'section3_image1',
        'section3_heading2',
        'section3_image2',
        'section3_heading3',
        'section3_image3',
        'section4_heading',
        'section4_sub_heading',
        'section4_button_name',
        'section4_button_url',
        'section4_image1',
        'section4_image2',
        'section5_heading1',
        'section5_sub_heading1',
        'section5_icon1',
        'section5_heading2',
        'section5_sub_heading2',
        'section5_icon2',
        'section5_heading3',
        'section5_sub_heading3',
        'section5_icon3',
        'section5_heading4',
        'section5_sub_heading4',
        'section5_icon4',
      
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];
}
