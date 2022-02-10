<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PHPUnit\TextUI\XmlConfiguration\Constant;

class CreateFncConsultaRegiao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'create or replace
       function fnc_consulta_regiao(pLatitude varchar,
       pLongitude varchar)
       returns float as $vRegiao$
       declare
           vRegiao float = 0;

       begin

       select
           id
       into
           vRegiao
       from
           (
           select
               tb_regioes.id,
               (cast(tb_regioes.raio_entrega as double precision) - fnc_calcula_distancia(pLatitude,
               pLongitude,
               tb_regioes.latitude,
               tb_regioes.longitude)) as distancia
           from
               tb_regioes) regioes
       where
           regioes.distancia > 0
       order by
           regioes.distancia asc
       limit 1;

       if not found then
           vRegiao := 0;
       end if;

       return vRegiao;
       end;
       $vRegiao$ language plpgsql;';

        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS fnc_consulta_regiao;');
    }
}
