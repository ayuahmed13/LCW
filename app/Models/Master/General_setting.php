<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class General_setting extends Model
{
    use HasFactory;
    protected $fillable = [
            'Heading',
            'description',
            'map_link',
            'opening_hours',
            'email',
            'mobile',
            'address',
            'helpline_no.',

             'facebook_url',
             'linkedin_url',
             'instagram_url',
             'twitter_url',
             'skype_url',

                'account_name',
                'bsb',
                'account_number',
                'bank_name',
                'swift_code',
                'update_log',
                'last_updated_date',
                
             'created_ip_address',
             'modified_ip_address',
              'created_by',
              'modified_by',
               'status',
    ];
}
