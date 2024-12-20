<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone', 15);
            $table->date('date_of_birth');
            $table->string('password');
            $table->string('family_code', 50)->nullable();
            $table->string('role', 50);
            $table->string('relation_to_emergency', 255)->nullable();
            $table->string('emergency_contact', 15)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); //add manually
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
