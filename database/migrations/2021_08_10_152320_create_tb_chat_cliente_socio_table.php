<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbChatClienteSocioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_chat_cliente_socio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('mensagem');
            $table->unsignedBigInteger('socios_id')->nullable(true);
            $table->unsignedBigInteger('clientes_id')->nullable(true);
            $table->datetime('dt_envio');
            $table->unsignedBigInteger('vendas_id')->nullable(true);
            $table->boolean('cliente_remetente')->nullable(true);
            $table->boolean('substituicao')->nullable(true)->default(false);
            $table->datetime('dt_leitura')->nullable(true);
            $table->timestamps();


            $table->foreign('clientes_id')
                ->references('id')->on('tb_clientes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('socios_id')
                ->references('id')->on('tb_socios')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('vendas_id')
                ->references('id')->on('tb_vendas')
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
        Schema::dropIfExists('tb_chat_cliente_socio');
    }
}
