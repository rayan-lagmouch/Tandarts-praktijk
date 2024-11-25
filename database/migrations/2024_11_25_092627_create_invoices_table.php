<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('treatment_id')->constrained('treatments')->cascadeOnDelete();
            $table->string('number')->unique();
            $table->date('date');
            $table->decimal('amount', 10, 2);
            $table->string('status'); // Sent, Not Sent, Paid, etc.
            $table->boolean('is_active')->default(true);
            $table->text('note')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
