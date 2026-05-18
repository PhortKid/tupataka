<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expense_children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_id')->constrained('expense_parents')->onDelete('cascade');
            $table->foreignId('expense_name_id')->constrained('expense_category')->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expense_children');
    }
};
