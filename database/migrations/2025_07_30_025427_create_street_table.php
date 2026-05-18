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
        Schema::create('street', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->enum('status', ['0', '1'])->default('1');
            $table->foreignId('ward_id')->constrained('ward')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('district')->onDelete('cascade');
            $table->foreignId('region_id')->constrained('region')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('street');
    }
};
