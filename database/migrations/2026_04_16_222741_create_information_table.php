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
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->unique();     
            $table->string('city');
            $table->date('dateNaiss');             // Type DATE pour la date de naissance
            $table->integer('age')->nullable();    // Âge calculé ou stocké (optionnel)
            $table->string('diplome');
            $table->string('site')->nullable();    // Site web (URL)
            $table->boolean('freelance')->default(false); // Booléen pour freelance
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('information');
    }
};
