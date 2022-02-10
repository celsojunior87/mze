<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateFncCalculaDistancia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'CREATE OR REPLACE FUNCTION fnc_calcula_distancia(pLatitude1 varchar, pLongitude1 varchar, pLatitude2 varchar, pLongitude2 varchar)
       RETURNS float AS $dist$
       DECLARE
           dist float = 0;
           radlat1 float;
           radlat2 float;
           theta float;
           radtheta float;
           vLatitude1 float;
           vLongitude1 float;
           vLatitude2 float;
           vLongitude2 float;
       BEGIN

           vLatitude1 := pLatitude1;
           vLongitude1 := pLongitude1;
           vLatitude2 := pLatitude2;
           vLongitude2 := pLongitude2;

           if vLatitude1 = vLatitude2
       or vLongitude1 = vLongitude2
               then return dist;
           ELSE

               radlat1 = pi() * vLatitude1 / 180;
               radlat2 = pi() * vLatitude2 / 180;
               theta = vLongitude1 - vLongitude2;
               radtheta = pi() * theta / 180;
               dist = sin(radlat1) * sin(radlat2) + cos(radlat1) * cos(radlat2) * cos(radtheta);

               IF dist > 1 THEN dist = 1;

       end if;

               dist = acos(dist);
               dist = dist * 180 / pi();
               dist = dist * 60 * 1.1515;
               dist = dist * 1.609344;

               RETURN dist;

           END IF;
       END;
       $dist$ LANGUAGE plpgsql;';
        DB::unprepared($sql);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS fnc_calcula_distancia;');
    }
}
