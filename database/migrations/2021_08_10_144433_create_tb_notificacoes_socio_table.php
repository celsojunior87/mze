<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbNotificacoesSocioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_notificacoes_socio', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo',100);
            $table->string('descricao');
            $table->unsignedBigInteger('regioes_id')->nullable(true);
            $table->unsignedBigInteger('socios_id')->nullable(true);
            $table->unsignedBigInteger('promocoes_id')->nullable(true);
            $table->datetime('dt_agendamento')->nullable(true);
            $table->datetime('dt_envio')->nullable(true);
            $table->timestamps();


            $table->foreign('regioes_id')
                ->references('id')->on('tb_regioes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('socios_id')
                ->references('id')->on('tb_socios')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('promocoes_id')
                ->references('id')->on('tb_promocoes')
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
        Schema::dropIfExists('tb_notificacoes_socio');
    }
}
