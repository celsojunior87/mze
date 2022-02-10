<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToTbSociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_socios', function (Blueprint $table) {
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
        Schema::table('tb_socios', function (Blueprint $table) {
            $table->unsignedBigInteger('enderecos_id')->nullable(true);

            $table->foreign('enderecos_id')->references('id')->on('tb_enderecos');
        });
    }
}
