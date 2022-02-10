<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPromocoesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_promocoes';

    /**
     * Run the migrations.
     * @table tb_promocoes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('descricao');
            $table->datetime('dt_inicial');
            $table->datetime('dt_final');
            $table->string('url_imagem');
            $table->string('tipo', 45)->nullable()->default(null);
            $table->unsignedBigInteger('regioes_id');
            $table->foreign('id')
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
