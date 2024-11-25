<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreatmentsTable extends Migration
{
    public function up()
    {
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->date('date');
            $table->time('time');
            $table->string('treatment_type'); // Checkups, Fillings, etc.
            $table->text('description')->nullable();
            $table->decimal('cost', 10, 2);
            $table->string('status'); // Treated, Untreated, etc.
            $table->boolean('is_active')->default(true);
            $table->text('note')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('treatments');
    }
}
