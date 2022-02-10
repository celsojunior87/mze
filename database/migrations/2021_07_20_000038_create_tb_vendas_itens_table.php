<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbVendasItensTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_vendas_itens';

    /**
     * Run the migrations.
     * @table tb_vendas_itens
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('qt_pedida');
            $table->dateTime('dt_atualizacao')->nullable(true);
            $table->integer('qt_atendida')->default(0);
            $table->decimal('valor', 9, 2);
            $table->decimal('vl_desconto', 9, 2)->nullable()->default(null);
            $table->decimal('perc_desc', 4, 2)->nullable()->default(null);
            $table->decimal('perc_comissao', 4, 2)->nullable()->default(null);
            $table->decimal('vl_comissao', 45)->nullable();
            $table->unsignedBigInteger('vendas_id');
            $table->unsignedBigInteger('produtos_id');
            $table->unsignedBigInteger('filiais_id')->nullable(true);
            $table->timestamps();


            $table->foreign('produtos_id')
                ->references('id')->on('tb_produtos')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('filiais_id')
                ->references('id')->on('tb_filiais')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('vendas_id')
                ->references('id')->on('tb_vendas')
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
        Schema::dropIfExists($this->tableName);
    }
}
