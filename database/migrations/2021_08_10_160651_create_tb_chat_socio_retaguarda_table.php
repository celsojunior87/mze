<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbChatSocioRetaguardaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_chat_socio_retaguarda', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mensagem');
            $table->unsignedBigInteger('clientes_id');
            $table->datetime('dt_envio');
            $table->boolean('socio_remetente')->nullable(true);
            $table->datetime('dt_leitura')->nullable(true);
            $table->timestamps();


            $table->foreign('clientes_id')
                ->references('id')->on('tb_clientes')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_chat_socio_retaguarda');
    }
}
