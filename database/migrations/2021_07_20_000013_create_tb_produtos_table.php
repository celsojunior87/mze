<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbProdutosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_produtos';

    /**
     * Run the migrations.
     * @table tb_produtos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo', 150);
            $table->string('descricao');
            $table->integer('qt_caixa');
            $table->text('descricao_detalhada')->nullable()->default(null);
            $table->string('ean')->nullable()->default(null);
            $table->string('unidade', 45);
            $table->string('url_imagem')->nullable()->default(null);;
            $table->string('ncm')->nullable()->default(null);
            $table->tinyInteger('situacao')->default('1');
            $table->unsignedBigInteger('departamentos_id');
            $table->foreign('departamentos_id')
                ->references('id')->on('tb_departamentos')
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
