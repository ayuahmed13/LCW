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
        Schema::create('home_cms_data', function (Blueprint $table) {
            $table->id();

            $table->string('section1_heading1')->nullable();
            $table->String('section1_sub_heading1')->nullable();
            $table->String('section1_button_name1')->nullable();
            $table->String('section1_button_url1')->nullable();
            $table->String('section1_image1')->nullable();
            
            $table->string('section1_heading2')->nullable();
            $table->String('section1_sub_heading2')->nullable();
            $table->String('section1_button_name2')->nullable();
            $table->String('section1_button_url2')->nullable();
            $table->String('section1_image2')->nullable();
            
            $table->string('section1_heading3')->nullable();
            $table->String('section1_sub_heading3')->nullable();
            $table->String('section1_button_name3')->nullable();
            $table->String('section1_button_url3')->nullable();
            $table->String('section1_image3')->nullable();
            
            $table->text('section2_marquee_text')->nullable();

            $table->string('section3_heading1')->nullable();
            $table->String('section3_image1')->nullable();
            $table->string('section3_heading2')->nullable();
            $table->String('section3_image2')->nullable();
            $table->string('section3_heading3')->nullable();
            $table->String('section3_image3')->nullable();
            
            $table->string('section4_heading')->nullable();
            $table->string('section4_sub_heading')->nullable();
            $table->string('section4_button_name')->nullable();
            $table->string('section4_button_url')->nullable();
            $table->string('section4_image1')->nullable();
            $table->string('section4_image2')->nullable();

            $table->string('section5_heading1')->nullable();
            $table->string('section5_sub_heading1')->nullable();
            $table->string('section5_icon1')->nullable();
            $table->string('section5_heading2')->nullable();
            $table->string('section5_sub_heading2')->nullable();
            $table->string('section5_icon2')->nullable();
            $table->string('section5_heading3')->nullable();
            $table->string('section5_sub_heading3')->nullable();
            $table->string('section5_icon3')->nullable();
            $table->string('section5_heading4')->nullable();
            $table->string('section5_sub_heading4')->nullable();
            $table->string('section5_icon4')->nullable();
            

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
        Schema::dropIfExists('home_cms_data');
    }
};
