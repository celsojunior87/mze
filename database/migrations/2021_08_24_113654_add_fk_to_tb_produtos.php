<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToTbProdutos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_produtos', function (Blueprint $table) {
            $table->unsignedBigInteger('secoes_id')->nullable(true);

            $table->foreign('secoes_id')->references('id')->on('tb_secoes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_produtos', function (Blueprint $table) {
            //
        });
    }
}
