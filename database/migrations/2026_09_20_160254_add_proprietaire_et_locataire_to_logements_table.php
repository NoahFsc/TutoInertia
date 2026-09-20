<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('logements', function (Blueprint $table) {
            $table->foreignId('proprietaire_id')->after('id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('locataire_id')->nullable()->after('proprietaire_id')->constrained('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('logements', function (Blueprint $table) {
            $table->dropConstrainedForeignId('locataire_id');
            $table->dropConstrainedForeignId('proprietaire_id');
        });
    }
};
