<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_id',
        'order_date_time',
        'sub_total',
        'tax_per',
        'tax_amount',
        'shipping_charges',
        'is_couponcode',
        'couponcode',
        'couponcode_amount',
        'couponcode_per',
        'total_amount',

        'order_total_without_tax',
        'order_total_with_tax',

        'total_products',
        'order_status',

        'billing_address_type',
        'billing_address_first_name',
        'billing_address_last_name',
        'billing_address_email',
        'billing_address_phone',
        'billing_address_country_region',
        'billing_address_town_city',
        'billing_address_street',
        'billing_address_state',
        'billing_address_postal_code',
        'billing_address_note',

        'shipping_same_as_billing',

        'shipping_address_type',
        'shipping_address_first_name',
        'shipping_address_last_name',
        'shipping_address_email',
        'shipping_address_phone',
        'shipping_address_country_region',
        'shipping_address_town_city',
        'shipping_address_street',
        'shipping_address_state',
        'shipping_address_postal_code',
        'shipping_address_note',

        'payment_method',
        'payment_status',
        'paid_amount',
        'tracking_no',
        'tracking_url',
        'transaction_id',
        'currency',
        'api_payment_status',
        'courier_name',

        'payment_gayeway_response',
        'response',

        'invoice_no',
        'invoice_pdf',

        'order_placed_on',
        'order_confirmed_on',
        'order_inprocess_on',
        'order_packed_on',
        'order_shipped_on',
        'order_delivered_on',
        'order_cancelled_on',
        'order_verified_on',
        'order_not_verified_on',

        'order_confirmed_by',
        'order_inprocess_by',
        'order_packed_by',
        'order_shipped_by',
        'order_delivered_by',
        'order_cancelled_by',

        'order_cancelled_by_type',

        'pending_form_remark',
        'confirmed_form_remark',
        'inprocess_form_remark',


        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];
}
