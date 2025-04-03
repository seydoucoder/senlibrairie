<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('commande_livre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commande_id')->constrained('commandes')->onDelete('cascade');
            $table->foreignId('livre_id')->constrained('books')->onDelete('cascade');
            $table->integer('quantite');
            $table->float('prix_unitaire');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('commande_livre');
    }
};