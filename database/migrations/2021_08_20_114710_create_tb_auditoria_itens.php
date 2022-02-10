<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAuditoriaItens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_auditoria_itens', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('auditoria_id');
            $table->unsignedBigInteger('produtos_id');
            $table->decimal('qt_atual', 10, 2)->nullable();
            $table->decimal('qt_contagem', 10, 2)->nullable();
            $table->string('justificativa', 150)->nullable();
            $table->dateTime('dt_contagem')->nullable();


            $table->foreign('auditoria_id')
                ->references('id')->on('tb_auditoria')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('produtos_id')
                ->references('id')->on('tb_produtos')
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
        Schema::dropIfExists('tb_tb_auditoria_itens');
    }
}
