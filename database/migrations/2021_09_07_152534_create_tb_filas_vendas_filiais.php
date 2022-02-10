<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFilasVendasFiliais extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_filas_vendas_filiais', function (Blueprint $table) {
            $table->id();
            $table->dateTime('dt_fila');
            $table->dateTime('dt_aceite')->nullable();
            $table->dateTime('dt_rejeicao')->nullable();
            $table->string('motivo_rejeicao')->nullable();
            $table->unsignedBigInteger('vendas_id');
            $table->unsignedBigInteger('filiais_id');
            $table->unsignedBigInteger('produtos_id');
            $table->timestamps();

            $table->foreign('filiais_id')
                ->references('id')->on('tb_filiais')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('vendas_id')
                ->references('id')->on('tb_vendas')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('produtos_id')
                ->references('id')->on('tb_produtos')
                ->onDelete('cascade')
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
        Schema::dropIfExists('tb_filas_vendas_filiais');
    }
}
