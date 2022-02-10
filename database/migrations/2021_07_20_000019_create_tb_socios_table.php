<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTbSociosTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'tb_socios';

    /**
     * Run the migrations.
     * @table tb_socios
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('nome', 150);
            $table->string('email', 150);
            $table->string('cpf', 14);
            $table->string('telefone', 14);
            $table->boolean('situacao')->nullable(true)->default(null);
            $table->decimal('avaliacao_media')->nullable(true)->default(null);
            $table->decimal('raio_entrega', 10, 2)->nullable(true)->default(null);
            $table->timestamp('email_verified_at')->nullable()->default(null);

            $table->string('password');

            $table->string('url_foto');
            $table->string('url_documento_frente');
            $table->string('url_documento_verso');
            $table->rememberToken();

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
