<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->cascadeOnDelete();
            $table->string('number')->unique();
            $table->string('employee_type');
            $table->string('specialization')->nullable();
            $table->json('availability')->nullable(); // Stores availability as JSON
            $table->boolean('is_active')->default(true);
            $table->text('note')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
