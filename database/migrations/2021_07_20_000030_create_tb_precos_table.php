<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbPrecosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_precos';

    /**
     * Run the migrations.
     * @table tb_precos
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->decimal('preco', 12, 2);
            $table->decimal('perc_comisao', 5, 2)->nullable()->default(null);
            $table->decimal('valor_comisao', 12, 2)->nullable()->default(null);
            $table->unsignedBigInteger('regioes_id');
            $table->unsignedBigInteger('produtos_id');


            $table->foreign('produtos_id')
                ->references('id')->on('tb_produtos')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->foreign('regioes_id')
                ->references('id')->on('tb_regioes')
                ->onDelete('cascade')
                ->onUpdate('no action');

            $table->unique(['regioes_id', 'produtos_id']);
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
