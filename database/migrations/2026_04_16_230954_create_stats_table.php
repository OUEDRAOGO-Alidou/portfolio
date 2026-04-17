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
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->default('bi-briefcase'); // classe Bootstrap Icon
            $table->string('title');   // ex: "Projets réalisés"
            $table->integer('value');  // ex: 5
            $table->string('link')->nullable(); // lien optionnel (ex: vers page projets)
            $table->integer('order')->default(0); // pour l'ordre d'affichage
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stats');
    }
};
