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
        Schema::create('verified_customer', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('phone_number');
            $table->enum('customer_type', ['regular', 'irregular']);
            $table->foreignId('business_activity_id')->constrained('business_activity')->onDelete('cascade');
            $table->String('customer_id');
            $table->String('control_number');
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });

        //php artisan migrate --path=/database/migrations/2025_11_05_113707_create_verified_customer_table.php

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verified_customer');
    }
};
