<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbContasReceberTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_contas_receber';

    /**
     * Run the migrations.
     * @table tb_transacoes_clientes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->decimal('vl_total', 9, 2);
            $table->datetime('dt_pagamento');
            $table->decimal('vl_repasse', 9, 2)->nullable(true);
            $table->datetime('dt_repasse')->nullable(true);
            $table->string('codigo_retorno_pagamento')->nullable(true);
            $table->unsignedBigInteger('vendas_id');
            $table->timestamps();


            $table->foreign('vendas_id')
                ->references('id')->on('tb_vendas')
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
