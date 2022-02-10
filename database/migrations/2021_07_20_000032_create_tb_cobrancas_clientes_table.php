<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCobrancasClientesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_cobrancas_clientes';

    /**
     * Run the migrations.
     * @table tb_forma_pagamento_clientes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('descricao');
            $table->string('numero_cartao', 50);
            $table->string('dt_vencimento');
            $table->string('dt_ultima_atualizacao');
            $table->string('titular', 150);
            $table->string('cgc', 14);
            $table->string('endereco')->nullable();
            $table->string('token')->nullable();
            $table->string('bandeira_cartao')->nullable();
            $table->unsignedBigInteger('clientes_id');
            $table->unsignedBigInteger('tipos_cobrancas_id');
            $table->timestamps();


            $table->foreign('clientes_id')
                ->references('id')->on('tb_clientes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('tipos_cobrancas_id')
                ->references('id')->on('tb_tipos_cobrancas')
                ->onDelete('no action')
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
        Schema::dropIfExists($this->tableName);
    }
}
