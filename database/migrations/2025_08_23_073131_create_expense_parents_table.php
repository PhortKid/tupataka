<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('expense_parents', function (Blueprint $table) {
            $table->id();
            $table->date('expense_date');
            $table->unsignedBigInteger('payee_id'); // future relation to Payee/Supplier/Employee
            $table->string('voucher_no')->unique();
            $table->enum('approved_status', ['Pending', 'Approved'])->default('Pending');
            $table->enum('required_imprest', ['Yes', 'No'])->default('No');
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->date('approved_date')->nullable();
            $table->unsignedBigInteger('cashout_by')->nullable();
            $table->date('cashout_on')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->date('deleted_on')->nullable();
            $table->enum('active', ['0','1'])->default('1');
            $table->timestamps();

            // Relations to users table
            $table->foreign('approved_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('cashout_by')->references('id')->on('users')->nullOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('deleted_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('expense_parents');
    }
};
