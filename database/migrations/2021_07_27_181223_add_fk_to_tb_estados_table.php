<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToTbEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_estados', function (Blueprint $table) {
            $table->unsignedBigInteger('regiao_padrao_id')->nullable(true);

             $table->foreign('regiao_padrao_id')->references('id')->on('tb_regioes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_estados', function (Blueprint $table) {
            $table->unsignedBigInteger('regiao_padrao_id')->nullable(true);

            $table->foreign('regiao_padrao_id')->references('id')->on('tb_regioes');
        });
    }
}
