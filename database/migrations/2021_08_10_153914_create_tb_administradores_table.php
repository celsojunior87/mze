<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAdministradoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_administradores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cpf');
            $table->string('nome');
            $table->string('email');
            $table->boolean('status')->default(true);
            $table->timestamp('email_verified_at')->nullable()->default(null);
            $table->string('password');
            $table->string('url_foto')->nullable(true);
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
        Schema::dropIfExists('tb_administradores');
    }
}
