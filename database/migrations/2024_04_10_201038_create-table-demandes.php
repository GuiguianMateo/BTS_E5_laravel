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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('date');
            $table->timestamp('deadline');
            $table->boolean('delay');
            $table->foreignId('type_id')->constrained('types');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('praticien_id')->constrained('praticiens')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};
