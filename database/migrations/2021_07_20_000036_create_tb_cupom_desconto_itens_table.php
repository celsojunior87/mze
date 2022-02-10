<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCupomDescontoItensTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_cupom_desconto_itens';

    /**
     * Run the migrations.
     * @table tb_cupom_desconto_itens
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('qt_itens');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('cupom_descontos_id');
            $table->unsignedBigInteger('produtos_id');

            $table->foreign('cupom_descontos_id')
                ->references('id')->on('tb_cupom_descontos')
                ->onDelete('cascade')
                ->onUpdate('cascade');

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
