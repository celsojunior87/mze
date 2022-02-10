<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbVendasHistoricos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vendas_historicos', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->dateTime('data');
            $table->unsignedBigInteger('historicos_id');
            $table->unsignedBigInteger('vendas_id');

            $table->foreign('historicos_id')
                ->references('id')->on('tb_historicos')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('vendas_id')
                ->references('id')->on('tb_vendas')
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
        Schema::dropIfExists('tb_vendas_historicos');
    }
}
