<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbEnderecosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_enderecos';

    /**
     * Run the migrations.
     * @table tb_enderecos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('descricao', 60);
            $table->string('cep', 45);
            $table->string('endereco');
            $table->string('numero', 45);
            $table->string('uf', 45);
            $table->string('bairro', 45);
            $table->string('cidade', 45);
            $table->string('complemento')->nullable()->default(null);
            $table->string('tipo');
            $table->string('latitude', 45);
            $table->string('longitude', 45);
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
