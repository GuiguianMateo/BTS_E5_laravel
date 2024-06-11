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
        Schema::create('Prescription', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('qte_day');
            $table->foreignId('consultation_id')->constrained('consultation');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('Prescription', function (Blueprint $table) {
            //
        });
    }
};
