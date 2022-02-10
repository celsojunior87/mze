<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAgendamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_agendamentos', function (Blueprint $table) {
            $table->id();
            $table->datetime('dt_agendamento');
            $table->boolean('entregue');
            $table->timestamps();

            $table->unsignedBigInteger('vendas_id');


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
        Schema::dropIfExists('tb_agendamentos');
    }
}
