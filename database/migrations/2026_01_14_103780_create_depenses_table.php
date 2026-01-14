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
        Schema::create('depenses', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->string('libelle'); // ex: Achat marchandises
            $table->text('description')->nullable();
            $table->decimal('montant', 15, 2);
            $table->date('date_depense');
            $table->foreignId('categorie_depense_id')->nullable()->constrained();
            $table->enum('mode_paiement', ['cash', 'mobile_money', 'virement', 'cheque']);
            $table->enum('statut', ['payee', 'annulee'])->default('payee');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depenses');
    }
};
