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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->enum('gender',['male','female'])->nullable();
            $table->string('dob');
            $table->foreignId('designation_id')->constrained('designation')->onDelete('cascade');
            $table->string('nida');
            $table->string('nssf_refference');
            $table->string('tin_refference');
            $table->string('phone1');
            $table->string('phone2');
            $table->string('email');
            $table->string('residential_address');
            $table->string('permanent_address');
            $table->string('contact_person_name');
            $table->string('contact_person_mobile');
            $table->string('contact_person_address');
            $table->enum('status', ['0', '1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
