<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbProdutosFornecedoresTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_produtos_fornecedores';

    /**
     * Run the migrations.
     * @table tb_produtos_fornecedores
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('tb_produtos_id');
            $table->unsignedBigInteger('tb_fornecedores_id');

            $table->foreign('tb_fornecedores_id')
                ->references('id')->on('tb_fornecedores')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('tb_produtos_id', 'fk_tb_produtos_has_tb_fornecedores_tb_produtos1_idx')
                ->references('id')->on('tb_produtos')
                ->onDelete('no action')
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
        Schema::dropIfExists($this->tableName);
    }
}
