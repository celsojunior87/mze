<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbVendasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_vendas';

    /**
     * Run the migrations.
     * @table tb_vendas
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dt_venda', 45);
            $table->decimal('vl_total', 9, 2);
            $table->string('vl_desconto', 45);
            $table->string('avaliacao', 45)->nullable()->default(null);
            $table->string('num_pedido', 10);
            $table->boolean('retirada');
            $table->boolean('agendado');
            $table->boolean('pgto_pix')->default(false);
            $table->dateTime('dt_cancelamento')->nullable()->default(null);
            $table->string('observacao', 45)->nullable()->default(null);
            $table->unsignedBigInteger('clientes_id');
            $table->unsignedBigInteger('enderecos_id');
            $table->unsignedBigInteger('cupom_descontos_id')->nullable()->default(null);
            $table->unsignedBigInteger('cobrancas_clientes_id')->nullable()->default(null);
            $table->timestamps();


            $table->foreign('enderecos_id')
                ->references('id')->on('tb_enderecos')
                ->onDelete('no action')
                ->onUpdate('no action');


            $table->foreign('clientes_id')
                ->references('id')->on('tb_clientes')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('cupom_descontos_id')
                ->references('id')->on('tb_cupom_descontos')
                ->onDelete('no action')
                ->onUpdate('no action');


            $table->foreign('cobrancas_clientes_id')
                ->references('id')->on('tb_cobrancas_clientes')
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
