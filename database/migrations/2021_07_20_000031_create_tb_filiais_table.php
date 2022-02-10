<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbFiliaisTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_filiais';

    /**
     * Run the migrations.
     * @table tb_filiais
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('descricao')->nullable();
            $table->string('cnpj', 45)->nullable();
            $table->integer('tipo_filial');
            $table->string('url_imagem');
            $table->boolean('filial_aberta')->default(false);
            $table->string('token_filial')->nullable(true);
            $table->string('dt_inativacao')->nullable();
            $table->boolean('ativo')->default('0');
            $table->unsignedBigInteger('socios_id');
            $table->unsignedBigInteger('mix_id')->nullable();

            $table->foreign('socios_id')
                ->references('id')->on('tb_socios')
                ->onDelete('cascade')
                ->onUpdate('no action');
            $table->timestamps();

            $table->foreign('mix_id')
                ->references('id')->on('tb_mix')
                ->onDelete('cascade')
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
