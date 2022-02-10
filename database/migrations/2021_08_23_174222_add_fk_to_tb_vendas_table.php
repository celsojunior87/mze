<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFkToTbVendasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tb_vendas', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable(true);
            $table->foreign('status_id')->references('id')->on('tb_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tb_vendas', function (Blueprint $table) {
            $table->unsignedBigInteger('status_id')->nullable(true);
            $table->foreign('status_id')->references('id')->on('tb_status');
        });
    }
}
