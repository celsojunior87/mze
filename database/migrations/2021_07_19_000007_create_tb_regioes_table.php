<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbRegioesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_regioes';

    /**
     * Run the migrations.
     * @table tb_regioes
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('descricao');
            $table->string('latitude', 45);
            $table->string('longitude', 45);
            $table->decimal('raio_entrega', 10, 2)->nullable(true)->default(null);
            $table->unsignedBigInteger('estados_id');

            $table->foreign('estados_id')
                ->references('id')->on('tb_estados')
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
