<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->date('from_date');
            $table->date('to_date');
            $table->time('from_time');
            $table->time('to_time');
            $table->string('status'); // Present, Absent, Leave, Sick
            $table->boolean('is_active')->default(true);
            $table->text('note')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('availabilities');
    }
}
