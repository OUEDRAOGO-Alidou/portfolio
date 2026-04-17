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
        Schema::create('about_infos', function (Blueprint $table) {
            $table->id();
            $table->string('job_title')->nullable();
            $table->text('intro_text')->nullable();     // paragraphe sous le titre
            $table->text('intro_title')->nullable();     // paragraphe sous le titre
            $table->text('expertise_text')->nullable(); // liste des compétences (ou texte long)
            $table->text('performance_text')->nullable(); // liste des compétences (ou texte long)
            $table->text('parcour_text')->nullable(); // liste des compétences (ou texte long)
            $table->text('service_text')->nullable(); // liste des compétences (ou texte long)
            $table->text('temoin_text')->nullable(); // liste des compétences (ou texte long)
            $table->text('contact_text')->nullable(); // liste des compétences (ou texte long)
            $table->text('competence_text')->nullable(); // liste des compétences (ou texte long)
            $table->text('profile_text')->nullable();
            $table->text('realisation_text')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_infos');
    }
};
