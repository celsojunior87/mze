<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToTbFiliaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_filiais', function (Blueprint $table) {
            $table->unsignedBigInteger('administrador_id')->nullable(true);

            $table->foreign('administrador_id')->references('id')->on('tb_administradores');

            $table->unsignedBigInteger('enderecos_id')->nullable(true);

            $table->foreign('enderecos_id')->references('id')->on('tb_enderecos');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_filiais', function (Blueprint $table) {
            $table->unsignedBigInteger('administrador_id')->nullable(true);

            $table->foreign('administrador_id')->references('id')->on('tb_administradores');

            $table->unsignedBigInteger('enderecos_id')->nullable(true);

            $table->foreign('enderecos_id')->references('id')->on('tb_enderecos');
        });
    }
}
