<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbContasBancariasTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_contas_bancarias';

    /**
     * Run the migrations.
     * @table tb_contas_bancarias
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nome', 150);
            $table->string('titular');
            $table->string('agencia', 45);
            $table->string('num_conta', 45);
            $table->string('cpf', 14);
            $table->string('chave_pix')->nullable()->default(null);
            $table->unsignedBigInteger('socios_id');

            $table->unsignedBigInteger('instituicoes_financeiras_id')->nullable()->default(null);
            $table->foreign('instituicoes_financeiras_id')
                ->references('id')
                ->on('tb_instituicoes_financeiras');

            $table->timestamps();


            $table->foreign('socios_id')
                ->references('id')->on('tb_socios')
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
