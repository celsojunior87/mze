<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCupomDescontosRegioesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_cupom_descontos_regioes';

    /**
     * Run the migrations.
     * @table tb_cupom_descontos_regioes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedBigInteger('cupom_descontos_id');
            $table->unsignedBigInteger('regioes_id');
            $table->bigIncrements('id');

            $table->foreign('cupom_descontos_id')
                ->references('id')->on('tb_cupom_descontos')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('regioes_id')
                ->references('id')->on('tb_regioes')
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
