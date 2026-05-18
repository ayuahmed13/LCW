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
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();

            $table->string('order_id')->nullable();
            $table->string('product_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('product_main_image')->nullable();
            $table->string('product_price')->nullable();
            $table->string('product_offer_price')->nullable();
            $table->string('product_qty')->nullable();
           
            $table->string('product_tax_per')->nullable();
            $table->string('product_tax_amount')->nullable();
            $table->string('product_total_amount')->nullable();

            $table->string('sub_total_without_tax')->nullable();
            $table->string('sub_total_with_tax')->nullable();
            
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
        Schema::dropIfExists('order_products');
    }
};
