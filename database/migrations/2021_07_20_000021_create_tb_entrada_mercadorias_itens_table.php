<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbEntradaMercadoriasItensTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_entrada_mercadorias_itens';

    /**
     * Run the migrations.
     * @table tb_entrada_mercadorias_itens
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('quantidade');
            $table->decimal('valor', 9, 2);
            $table->unsignedBigInteger('entrada_mercadorias_id');
            $table->unsignedBigInteger('produtos_id');


            $table->foreign('entrada_mercadorias_id')
                ->references('id')->on('tb_entrada_mercadorias')
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
        Schema::dropIfExists($this->tableName);
    }
}
