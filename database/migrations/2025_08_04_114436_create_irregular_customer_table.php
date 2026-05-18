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
        Schema::create('irregular_customer', function (Blueprint $table) {
            $table->id();
            $table->string('company_or_institution_name');
            $table->string('tin')->nullable();
            $table->string('phone_number');
            $table->string('reg_no');
            $table->string('user_id');
            $table->string('gps_coordinates')->nullable();
            $table->foreignId('ward_id')->constrained('ward')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('district')->onDelete('cascade');
            $table->foreignId('region_id')->constrained('region')->onDelete('cascade');
            $table->foreignId('street_id')->constrained('street')->onDelete('cascade');
            $table->string('plot_no')->nullable();
            $table->string('house_owner_mobile')->nullable();
            $table->foreignId('business_activity_id')->constrained('business_activity')->onDelete('cascade');
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('irregular_customer');
    }
};
