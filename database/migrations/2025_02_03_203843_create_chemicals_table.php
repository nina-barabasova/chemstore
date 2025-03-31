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
        Schema::create('chemicals', function (Blueprint $table) {
            $table->id();
            $table->string('chemical_formula');
            $table->string('chemical_name_en');
            $table->string('chemical_name_sk');
            $table->string('disposal_en')->nullable();
            $table->string('disposal_sk')->nullable();
            $table->string('access_en');
            $table->string('access_sk');
            $table->foreignId('supplies_id')->constrained()->restrictOnDelete();;
            $table->foreignId('measure_unit_id')->constrained()->restrictOnDelete();
            $table->text('description_en')->nullable();
            $table->text('description_sk')->nullable();
            $table->timestamps();

      //      $table->foreign('measure_unit_id')->references('id')->on('measure_units')->restrictOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chemicals');
    }
};
