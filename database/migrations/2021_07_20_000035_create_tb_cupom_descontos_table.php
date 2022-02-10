<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbCupomDescontosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_cupom_descontos';

    /**
     * Run the migrations.
     * @table tb_cupom_descontos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('codigo_cupom');
            $table->datetime('dt_inicial');
            $table->datetime('dt_final');
            $table->decimal('perc_desc', 3, 2)->nullable();
            $table->decimal('vl_desc', 9, 2)->nullable()->default(null);

            $table->unsignedBigInteger('regioes_id');


            $table->foreign('regioes_id')
                ->references('id')->on('tb_regioes')
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
