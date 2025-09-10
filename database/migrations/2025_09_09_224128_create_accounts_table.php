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
        Schema::create('accounts', function (Blueprint $table) {

            $table->string('id_account', 20)->primary(); // ex: ACC-1234-5678
            $table->string('id_customer', 20);
            $table->enum('montant_plan', ['25','50','100','250','500','1000','2500','5000']);
            $table->integer('nb_jours');
            $table->decimal('solde', 10, 2)->default(0);
            $table->integer('nb_jours_rester');
            $table->enum('etat', ['actif','inactif','bloquer'])->default('actif');
            $table->timestamps();

            $table->foreign('id_customer')->references('id_customer')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
