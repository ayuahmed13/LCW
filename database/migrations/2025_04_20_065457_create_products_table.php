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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('category_id')->nullable();
            $table->bigInteger('sub_category_id')->nullable();
            $table->bigInteger('sub_sub_category_id')->nullable();
            $table->bigInteger('brand_id')->nullable();
            
            $table->string('product_name')->nullable();
            $table->string('product_id')->nullable();
            $table->string('slug_url')->nullable();
            $table->string('product_main_image')->nullable();

            // $table->text('gallery_images')->nullable();
            // $table->string('download_file')->nullable();
            // $table->string('description_image')->nullable();

            $table->string('sku')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->decimal('offer_price', 15, 2)->nullable();

            $table->string('is_gst')->nullable();
            $table->string('gst_id')->nullable();

            $table->text('description')->nullable();
            $table->text('specification')->nullable();

            // $table->string('is_voltage')->nullable();
            // $table->string('voltage_id')->nullable();
            
            // $table->string('is_wattage')->nullable();
            // $table->string('wattage_id')->nullable();
            
            // $table->string('is_iprate')->nullable();
            // $table->string('iprate_id')->nullable();
            
            $table->string('current_stock')->nullable();
            $table->text('stock_remark')->nullable();
            $table->enum('status', ['avialable', 'not_avialable'])->default('avialable');
            
            $table->string('meta_title')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            
            $table->string('controller_product_ids')->nullable();
            $table->string('tab_name')->nullable();
            $table->text('short_description')->nullable();
            $table->enum('extra_tab', ['no', 'yes'])->default('no');
            
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
        Schema::dropIfExists('products');
    }
};
