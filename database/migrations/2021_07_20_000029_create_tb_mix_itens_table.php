<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbMixItensTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_mix_itens';

    /**
     * Run the migrations.
     * @table tb_mix_itens
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('mix_id');
            $table->unsignedBigInteger('produtos_id');

            $table->foreign('mix_id')
                ->references('id')->on('tb_mix')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('produtos_id')
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
