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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('lien')->nullable();     // URL du projet (GitHub, démo, etc.)
            $table->string('categorie')->default('Web'); // Web, Data, Excel, etc.
            $table->string('categorie_slug')->nullable(); // filter-web, filter-data...
            $table->json('technologies')->nullable(); // stocker un tableau ["Laravel","Vue","MySQL"]
            $table->string('chiffre_cle')->nullable(); // ex: "+30% performance"
            $table->integer('ordre')->default(0);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
