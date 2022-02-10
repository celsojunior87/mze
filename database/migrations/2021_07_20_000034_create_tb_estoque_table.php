<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbEstoqueTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_estoque';

    /**
     * Run the migrations.
     * @table tb_estoque
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->integer('quantidade');
            $table->unsignedBigInteger('produtos_id');
            $table->unsignedBigInteger('filiais_id');
            $table->timestamps();


            $table->foreign('filiais_id')
                ->references('id')->on('tb_filiais')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('produtos_id')
                ->references('id')->on('tb_produtos')
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
