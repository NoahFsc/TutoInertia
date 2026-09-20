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
        Schema::create('demande_travaux', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logement_id')->constrained();
            $table->foreignId('auteur_id')->constrained('users');
            $table->string('titre');
            $table->text('description');
            $table->string('urgence');
            $table->string('statut')->default('en_attente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demande_travaux');
    }
};
