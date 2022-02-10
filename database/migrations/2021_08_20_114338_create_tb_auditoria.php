<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAuditoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_auditoria', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('descricao');
            $table->integer('tipo');
            $table->dateTime('dt_criacao');
            $table->dateTime('dt_finalizacao')->nullable();
            $table->unsignedBigInteger('filiais_id');


            $table->foreign('filiais_id')
                ->references('id')->on('tb_filiais')
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
        Schema::dropIfExists('tb_tb_auditoria');
    }
}
