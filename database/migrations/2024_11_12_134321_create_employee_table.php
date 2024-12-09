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
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // This creates the primary key 'id' (auto-incrementing)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key referencing users
            $table->bigInteger('emp_id')->unique(); // Non-auto-incrementing unique 'emp_id'
            $table->string('role');
            $table->decimal('salary', 10, 2)->nullable(); // Nullable salary field
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees'); // Corrected table name
    }
};

