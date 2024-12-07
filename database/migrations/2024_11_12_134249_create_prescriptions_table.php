<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('patient_id'); 
            $table->unsignedBigInteger('doctor_id'); 
            $table->text('comment')->nullable();
            $table->string('morning_med')->nullable(); 
            $table->string('afternoon_med')->nullable(); 
            $table->string('night_med')->nullable();
            $table->timestamps(); 
        
            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('cascade'); 
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
}

// php artisan migrate --path=/database/migrations/2024_11_12_134146_create_appointments_table.php
// php artisan migrate --path=/database/migrations/2024_11_12_134155_create_roles_table.php
// php artisan migrate --path=/database/migrations/2024_11_12_134228_create_rosters_table.php
// php artisan migrate --path=/database/migrations/2024_11_12_134243_create_payments_table.php
// php artisan migrate --path=/database/migrations/2024_11_12_134249_create_prescriptions_table.php
// php artisan migrate --path=/database/migrations/2024_11_12_134304_create_family_members_table.php
// php artisan migrate --path=/database/migrations/2024_11_12_134321_create_employee_table.php
// php artisan migrate --path=/database/migrations/2024_11_12_134945_create_appointments_table.php
// php artisan migrate --path=/database/migrations/2024_11_12_135608_create_appointments_table.php


