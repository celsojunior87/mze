<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPromocoesRegioesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_promocoes_regioes';

    /**
     * Run the migrations.
     * @table tb_promocoes_regioes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('promocoes_id');
            $table->unsignedBigInteger('regioes_id');

            $table->foreign('promocoes_id')
                ->references('id')->on('tb_promocoes')
                ->onDelete('cascade')
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
