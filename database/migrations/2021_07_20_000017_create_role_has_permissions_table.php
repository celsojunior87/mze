<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleHasPermissionsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'role_has_permissions';

    /**
     * Run the migrations.
     * @table role_has_permissions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->index(["role_id"], 'role_has_permissions_role_id_foreign');


            $table->foreign('permission_id', 'role_has_permissions_permission_id')
                ->references('id')->on('permissions')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('role_id', 'role_has_permissions_role_id_foreign')
                ->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('restrict');
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
