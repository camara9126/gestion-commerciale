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
        Schema::create('paiement_abonnements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entreprise_id')->constrained();
            $table->foreignId('pack_id')->constrained();
            $table->decimal('montant', 10, 2);
            $table->string('reference')->unique();
            $table->string('statut')->default('en_attente');
            $table->string('moyen_paiement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement_abonnements');
    }
};
