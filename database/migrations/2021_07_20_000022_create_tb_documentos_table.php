<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbDocumentosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_documentos';

    /**
     * Run the migrations.
     * @table tb_documentos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->bigInteger('usuario_id');
            $table->string('url_imagen');
            $table->integer('tipodoc')->nullable()->default(null);
            $table->unsignedBigInteger('socios_id');

            $table->foreign('socios_id')
                ->references('id')->on('tb_socios')
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
