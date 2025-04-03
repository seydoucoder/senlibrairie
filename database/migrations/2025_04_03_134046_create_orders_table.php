<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->datetime('dateCommande')->default(now());
            $table->enum('statut', ['En attente', 'En préparation', 'Expédiée', 'Payée'])->default('En attente');
            $table->float('montantTotal');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commandes');
    }
};