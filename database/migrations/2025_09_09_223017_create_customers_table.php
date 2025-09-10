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
        Schema::create('customers', function (Blueprint $table) {

            $table->string('id_customer', 20)->primary(); // ex: CUST-1234-5678
            $table->string('nom', 100);
            $table->string('prenom', 100);
            $table->string('adresse');
            $table->string('telephone', 20);
            $table->string('email', 100)->unique();
            $table->boolean('is_verified_mail')->default(false);
            $table->string('activite')->nullable();
            $table->string('image')->nullable();
            $table->enum('etat', ['actif','inactif','bloquer'])->default('actif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
