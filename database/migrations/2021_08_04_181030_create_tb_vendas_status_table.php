<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbVendasStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_vendas_status', function (Blueprint $table) {
            $table->id();
            $table->boolean('ativo')->default(1);
            $table->dateTime('dt_atualizacao')->nullable(true);
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('vendas_id');
            $table->foreign('status_id')->references('id')->on('tb_status');
            $table->foreign('vendas_id')->references('id')->on('tb_vendas');
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
        Schema::dropIfExists('tb_vendas_status');
    }
}
