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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('fullname_business_name')->nullable(); // fullname/business_name
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('reg_no')->unique()->nullable();
            $table->string('gps_coordinates')->nullable(); // gps_coordinates
            $table->foreignId('ward_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('region_id')->nullable();
            $table->foreignId('street_id')->nullable();
            $table->string('house_no')->nullable(); // house_no(allow alphabet & character)
            $table->string('house_owner_mobile')->nullable();
            $table->integer('idadi_kaya')->default(1);
            $table->foreignId('business_activity_id')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->string('customer_type')->default('regular'); // customer_type
            $table->decimal('irregular_amount', 15, 2)->nullable();
            $table->foreignId('registered_by')->nullable()->constrained('users')->onDelete('set null');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
