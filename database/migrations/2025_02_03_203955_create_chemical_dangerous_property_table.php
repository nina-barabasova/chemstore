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
        Schema::create('chemical_dangerous_property', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chemical_id')->constrained()->onDelete('cascade');
            $table->foreignId('dangerous_property_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chemical_dangerous_property');
    }
};
