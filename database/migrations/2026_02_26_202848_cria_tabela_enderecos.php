<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriaTabelaEnderecos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id();
            $table->string('cep', 9);
            $table->string('logradouro', 120);
            $table->string('numero', 10);
            $table->string('bairro', 80);
            $table->string('cidade', 80);
            $table->string('estado', 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('enderecos');
    }
}
