<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\PseudoTypes\True_;

class CreateTbParametrosPresidencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_parametros_presidencias', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('aplicacao');
            $table->string('descricao');
            $table->string('valor');

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
        Schema::dropIfExists('tb_parametros_presidencias');
    }
}
