<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEnderecosClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_enderecos_clientes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('clientes_id');
            $table->unsignedBigInteger('enderecos_id');

            $table->foreign('clientes_id')
                ->references('id')->on('tb_clientes')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('enderecos_id')
                ->references('id')->on('tb_enderecos')
                ->onDelete('cascade')
                ->onUpdate('no action');
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
        Schema::dropIfExists('tb_enderecos_clientes');
    }
}
