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
        Schema::create('user_registers', function (Blueprint $table) {
            $table->id();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('appartment')->nullable();
            $table->string('pincode')->nullable();
            $table->string('password')->nullable();
            $table->string('user_timezone')->nullable();
           
            $table->string('otp')->nullable();
            $table->string('is_otp_verified')->default('no');
            $table->string('otp_verified_at')->nullable();
            $table->string('access_token')->nullable();

            $table->string('last_login')->nullable();
            $table->string('is_logged_in')->nullable();

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
        Schema::dropIfExists('user_registers');
    }
};
