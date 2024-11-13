<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissedActivitiesTable extends Migration
{
    public function up()
    {
        Schema::create('missed_activities', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name');
            $table->string('doctor_name');
            $table->date('appointment_date');
            $table->string('caregiver_name');
            $table->boolean('morning_medicine')->default(false);
            $table->boolean('afternoon_medicine')->default(false);
            $table->boolean('night_medicine')->default(false);
            $table->boolean('breakfast')->default(false);
            $table->boolean('lunch')->default(false);
            $table->boolean('dinner')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('missed_activities');
    }
};
