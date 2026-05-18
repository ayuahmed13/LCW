<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('user_id')->nullable();
            $table->string('order_id')->nullable();
            $table->string('order_date_time')->nullable();

            $table->string('sub_total')->nullable();
            $table->string('tax_per')->nullable();
            $table->string('tax_amount')->nullable();
            $table->string('shipping_charges')->nullable();
            $table->enum('is_couponcode', ['no', 'yes'])->default('no');
            $table->string('couponcode')->nullable();
            $table->string('couponcode_amount')->nullable();
            $table->string('couponcode_per')->nullable();
            
            $table->string('total_amount')->nullable();
            $table->string('total_products')->nullable();

            $table->string('order_total_without_tax')->nullable();
            $table->string('order_total_with_tax')->nullable();

            $table->enum('order_status', ['pending', 'confirmed', 'inprocess','delivered','cancelled','payment_pending','not_verified','packed','shipped'])->default('pending');

            $table->string('billing_address_type')->nullable(); 
            $table->string('billing_address_first_name')->nullable();
            $table->string('billing_address_last_name')->nullable();
            $table->string('billing_address_email')->nullable();
            $table->string('billing_address_phone')->nullable();
            $table->string('billing_address_country_region')->nullable();
            $table->string('billing_address_town_city')->nullable();
            $table->string('billing_address_street')->nullable();
            $table->string('billing_address_state')->nullable();
            $table->string('billing_address_postal_code')->nullable();
            $table->string('billing_address_note')->nullable();

            $table->string('shipping_same_as_billing')->nullable();

            $table->string('shipping_address_type')->nullable(); 
            $table->string('shipping_address_first_name')->nullable();
            $table->string('shipping_address_last_name')->nullable();
            $table->string('shipping_address_email')->nullable();
            $table->string('shipping_address_phone')->nullable();
            $table->string('shipping_address_country_region')->nullable();
            $table->string('shipping_address_town_city')->nullable();
            $table->string('shipping_address_street')->nullable();
            $table->string('shipping_address_state')->nullable();
            $table->string('shipping_address_postal_code')->nullable();
            $table->string('shipping_address_note')->nullable();

            $table->string('payment_method')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('api_payment_status')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('paid_currency')->nullable();
            $table->string('tracking_no')->nullable();
            $table->string('tracking_url')->nullable();
            $table->string('transaction_id')->nullable();

            $table->text('payment_gayeway_response')->nullable();
            $table->longText('response')->nullable();

            $table->string('invoice_no')->nullable();
            $table->string('invoice_pdf')->nullable();

            $table->string('order_placed_on')->nullable();
            $table->string('order_confirmed_on')->nullable();
            $table->string('order_inprocess_on')->nullable();
            $table->string('order_packed_on')->nullable();
            $table->string('order_shipped_on')->nullable();
            $table->string('order_delivered_on')->nullable();
            $table->string('order_canceled_on')->nullable();
            $table->string('order_verified_on')->nullable();
            $table->string('order_not_verified_on')->nullable();

            $table->string('order_confirmed_by')->nullable();
            $table->string('order_inprocess_by')->nullable();
            $table->string('order_packed_by')->nullable();
            $table->string('order_shipped_by')->nullable();
            $table->string('order_delivered_by')->nullable();
            $table->string('order_cancelled_by')->nullable();

            $table->string('order_cancelled_by_type')->nullable();
            $table->string('courier_name')->nullable();

            $table->string('pending_form_remark')->nullable();
            $table->string('confirmed_form_remark')->nullable();
            $table->string('inprocess_form_remark')->nullable();

            $table->string('created_ip_address')->nullable();
            $table->string('modified_ip_address')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('modified_by')->nullable();
            $table->enum('status', ['active', 'delete', 'inactive'])->default('active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
