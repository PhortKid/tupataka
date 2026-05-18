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
        Schema::create('petty_cash_received', function (Blueprint $table) {
            $table->id();
            $table->string('date_received');
            $table->foreignId('cash_source_id')->constrained('petty_cash_source')->onDelete('cascade');
            $table->decimal('amount',10,2);
            $table->string('description');
            $table->enum('status', ['0', '1'])->default('1');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('updated_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petty_cash_received');
    }
};
