<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_produtos')->insert([
            "titulo" => "QUEIJO PARMESAO ITAMBE RALADO 50G",
            "descricao" => "QUEIJO PARMESAO ITAMBE RALADO 50G",
            "descricao_detalhada" => "QUEIJO PARMESAO ITAMBE RALADO 50G",
            "ean" => 7896051165491,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896051165491.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 10,
            "qt_caixa" => 20
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "POLVILHO DOCE DA MAMAE 1KG",
            "descricao" => "POLVILHO DOCE DA MAMAE 1KG",
            "descricao_detalhada" => "POLVILHO DOCE DA MAMAE 1KG",
            "ean" => 7896916200251,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896916200251.png",
            "ncm" => "11081400.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 10
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "RACAO P/GATOS PURINA FRISKIES CARNE 1KG",
            "descricao" => "RACAO P/GATOS PURINA FRISKIES CARNE 1KG",
            "descricao_detalhada" => "RACAO P/GATOS PURINA FRISKIES CARNE 1KG",
            "ean" => 7891000069905,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891000069905.png",
            "ncm" => "23099010.",
            "situacao" => 1,
            "departamentos_id" => 6,
            "secoes_id" => 12,
            "qt_caixa" => 15
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "BISC ROSQUINHA MABEL COCO 700G",
            "descricao" => "BISC ROSQUINHA MABEL COCO 700G",
            "descricao_detalhada" => "BISC ROSQUINHA MABEL COCO 700G",
            "ean" => 7896071025157,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896071025157.png",
            "ncm" => 19053100.18,
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 25
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "FILME PVC PICOTADO WYDA 21MTS",
            "descricao" => "FILME PVC PICOTADO WYDA 21MTS",
            "descricao_detalhada" => "FILME PVC PICOTADO WYDA 21MTS",
            "ean" => 7898930673608,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7898930673608.png",
            "ncm" => "39204390.",
            "situacao" => 1,
            "departamentos_id" => 2,
            "secoes_id" => 4,
            "qt_caixa" => 10
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "FARINHA MANDIOCA FINA KICALDO BCA 1KG",
            "descricao" => "FARINHA MANDIOCA FINA KICALDO BCA 1KG",
            "descricao_detalhada" => "FARINHA MANDIOCA FINA KICALDO BCA 1KG",
            "ean" => 7896116900623,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896116900623.png",
            "ncm" => "11062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 11,
            "qt_caixa" => 10
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "PAPEL TOALHA HIPER SNOB MULTIUSO 240UN",
            "descricao" => "PAPEL TOALHA HIPER SNOB MULTIUSO 240UN",
            "descricao_detalhada" => "PAPEL TOALHA HIPER SNOB MULTIUSO 240UN",
            "ean" => 7896110009544,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896110009544.png",
            "ncm" => 48189090.1,
            "situacao" => 1,
            "departamentos_id" => 2,
            "secoes_id" => 4,
            "qt_caixa" => 20
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "LAVA ROUPAS PO OMO LAV PERF 800G",
            "descricao" => "LAVA ROUPAS PO OMO LAV PERF 800G",
            "descricao_detalhada" => "LAVA ROUPAS PO OMO LAV PERF 800G",
            "ean" => 7891150064317,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891150064317.png",
            "ncm" => 34022000.12,
            "situacao" => 1,
            "departamentos_id" => 4,
            "secoes_id" => 8,
            "qt_caixa" => 12
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "LIMP DESENG VEJA 30%GTS 500ML",
            "descricao" => "LIMP DESENG VEJA 30%GTS 500ML",
            "descricao_detalhada" => "LIMP DESENG VEJA 30%GTS 500ML",
            "ean" => 7891035800054,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891035800054.png",
            "ncm" => 34022000400,
            "situacao" => 1,
            "departamentos_id" => 4,
            "secoes_id" => 7,
            "qt_caixa" => 21
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "BALDE PLASTICO SANREMO VERDE 8LT",
            "descricao" => "BALDE PLASTICO SANREMO VERDE 8LT",
            "descricao_detalhada" => "BALDE PLASTICO SANREMO VERDE 8LT",
            "ean" => 7896359012237,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896359012237.png",
            "ncm" => 39249000.18,
            "situacao" => 1,
            "departamentos_id" => 4,
            "secoes_id" => 6,
            "qt_caixa" => 12
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "BISC LEITE MABEL 400G",
            "descricao" => "BISC LEITE MABEL 400G",
            "descricao_detalhada" => "BISC LEITE MABEL 400G",
            "ean" => 7896071001977,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896071001977.png",
            "ncm" => 19053100.1,
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 24
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "DESOD AERO DOVE FEM ORIG 89G",
            "descricao" => "DESOD AERO DOVE FEM ORIG 89G",
            "descricao_detalhada" => "DESOD AERO DOVE FEM ORIG 89G",
            "ean" => 7506306241183,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7506306241183.png",
            "ncm" => "33072010.",
            "situacao" => 1,
            "departamentos_id" => 3,
            "secoes_id" => 5,
            "qt_caixa" => 6
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "LEITE DE COCO COPRA VD 200ML",
            "descricao" => "LEITE DE COCO COPRA VD 200ML",
            "descricao_detalhada" => "LEITE DE COCO COPRA VD 200ML",
            "ean" => 7898905356161,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7898905356161.png",
            "ncm" => "20098990.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 10,
            "qt_caixa" => 12
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "CERVEJA HEINEKEN LN 330ML",
            "descricao" => "CERVEJA HEINEKEN LN 330ML",
            "descricao_detalhada" => "CERVEJA HEINEKEN LN 330ML",
            "ean" => 78936683,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/78936683.png",
            "ncm" => 22030000362,
            "situacao" => 1,
            "departamentos_id" => 1,
            "secoes_id" => 2,
            "qt_caixa" => 144
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "SH SEDA PUREZA REFRESCANTE 325ML",
            "descricao" => "SH SEDA PUREZA REFRESCANTE 325ML",
            "descricao_detalhada" => "SH SEDA PUREZA REFRESCANTE 325ML",
            "ean" => 7891150037564,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891150037564.png",
            "ncm" => "33051000.",
            "situacao" => 1,
            "departamentos_id" => 3,
            "secoes_id" => 5,
            "qt_caixa" => 6
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "RACAO BOMGUY CARNE COEX 1KG",
            "descricao" => "RACAO BOMGUY CARNE COEX 1KG",
            "descricao_detalhada" => "RACAO BOMGUY CARNE COEX 1KG",
            "ean" => 7897907600159,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7897907600159.png",
            "ncm" => "23091000.",
            "situacao" => 1,
            "departamentos_id" => 6,
            "secoes_id" => 12,
            "qt_caixa" => 6
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "ESPONJA MULTIUSO BOMBRIL LV 4 PG 3",
            "descricao" => "ESPONJA MULTIUSO BOMBRIL LV 4 PG 3",
            "descricao_detalhada" => "ESPONJA MULTIUSO BOMBRIL LV 4 PG 3",
            "ean" => 7891022859812,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891022859812.png",
            "ncm" => 68053090.1,
            "situacao" => 1,
            "departamentos_id" => 4,
            "secoes_id" => 7,
            "qt_caixa" => 25
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "PALITO DENTE GINA 200 UND",
            "descricao" => "PALITO DENTE GINA 200 UND",
            "descricao_detalhada" => "PALITO DENTE GINA 200 UND",
            "ean" => 7896051020158,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896051020158.png",
            "ncm" => "44219900.",
            "situacao" => 1,
            "departamentos_id" => 2,
            "secoes_id" => 4,
            "qt_caixa" => 25
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "AGUA SANIT YPE 2LT",
            "descricao" => "AGUA SANIT YPE 2LT",
            "descricao_detalhada" => "AGUA SANIT YPE 2LT",
            "ean" => 7896098904688,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896098904688.png",
            "ncm" => "28289011.",
            "situacao" => 1,
            "departamentos_id" => 4,
            "secoes_id" => 7,
            "qt_caixa" => 20
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "AMAC MINUANO CLASSICO AZUL 2L",
            "descricao" => "AMAC MINUANO CLASSICO AZUL 2L",
            "descricao_detalhada" => "AMAC MINUANO CLASSICO AZUL 2L",
            "ean" => 7897664150010,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7897664150010.png",
            "ncm" => "38099190.",
            "situacao" => 1,
            "departamentos_id" => 4,
            "secoes_id" => 8,
            "qt_caixa" => 6
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "COPO DESCART COPOBRAS PS TRANSP 200ML",
            "descricao" => "COPO DESCART COPOBRAS PS TRANSP 200ML",
            "descricao_detalhada" => "COPO DESCART COPOBRAS PS TRANSP 200ML",
            "ean" => 7896030892530,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896030892530.png",
            "ncm" => "39241000.",
            "situacao" => 1,
            "departamentos_id" => 2,
            "secoes_id" => 3,
            "qt_caixa" => 12
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "FACA DESC STRAWPLAST CRIS REFEICA 50UN",
            "descricao" => "FACA DESC STRAWPLAST CRIS REFEICA 50UN",
            "descricao_detalhada" => "FACA DESC STRAWPLAST CRIS REFEICA 50UN",
            "ean" => 7898202617033,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7898202617033.png",
            "ncm" => "39241000.",
            "situacao" => 1,
            "departamentos_id" => 2,
            "secoes_id" => 3,
            "qt_caixa" => 12
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "SUCO NUTRI NECTAR UVA 1L",
            "descricao" => "SUCO NUTRI NECTAR UVA 1L",
            "descricao_detalhada" => "SUCO NUTRI NECTAR UVA 1L",
            "ean" => 7898920195141,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7898920195141.png",
            "ncm" => "22029900.",
            "situacao" => 1,
            "departamentos_id" => 1,
            "secoes_id" => 1,
            "qt_caixa" => 6
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "RODO CONDOR DUPLO 40CM",
            "descricao" => "RODO CONDOR DUPLO 40CM",
            "descricao_detalhada" => "RODO CONDOR DUPLO 40CM",
            "ean" => 7891055128602,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891055128602.png",
            "ncm" => "96039000.",
            "situacao" => 1,
            "departamentos_id" => 4,
            "secoes_id" => 6,
            "qt_caixa" => 336
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "VASSOURA CONDOR V-9",
            "descricao" => "VASSOURA CONDOR V-9",
            "descricao_detalhada" => "VASSOURA CONDOR V-9",
            "ean" => 7891055006771,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891055006771.png",
            "ncm" => "96031000.",
            "situacao" => 1,
            "departamentos_id" => 4,
            "secoes_id" => 6,
            "qt_caixa" => 10
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "REFRI GUARANA ANTARCTICA 2LT",
            "descricao" => "REFRI GUARANA ANTARCTICA 2LT",
            "descricao_detalhada" => "REFRI GUARANA ANTARCTICA 2LT",
            "ean" => 7891991001342,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891991001342.png",
            "ncm" => 220210001019,
            "situacao" => 1,
            "departamentos_id" => 1,
            "secoes_id" => 1,
            "qt_caixa" => 12
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "AP BARB PROBAK II REGULAR C/ 2UN",
            "descricao" => "AP BARB PROBAK II REGULAR C/ 2UN",
            "descricao_detalhada" => "AP BARB PROBAK II REGULAR C/ 2UN",
            "ean" => 7702018118823,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7702018118823.png",
            "ncm" => "82121020.",
            "situacao" => 1,
            "departamentos_id" => 3,
            "secoes_id" => 5,
            "qt_caixa" => 480
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "CATUABA SELVAGEM 1L",
            "descricao" => "CATUABA SELVAGEM 1L",
            "descricao_detalhada" => "CATUABA SELVAGEM 1L",
            "ean" => 7896336802189,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896336802189.png",
            "ncm" => "22089000.",
            "situacao" => 1,
            "departamentos_id" => 1,
            "secoes_id" => 2,
            "qt_caixa" => 12
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "ICE SMIRNOFF RED 275ML",
            "descricao" => "ICE SMIRNOFF RED 275ML",
            "descricao_detalhada" => "ICE SMIRNOFF RED 275ML",
            "ean" => 7893218003603,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7893218003603.png",
            "ncm" => "22086000.",
            "situacao" => 1,
            "departamentos_id" => 1,
            "secoes_id" => 2,
            "qt_caixa" => 24
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "COPO NADIR AMERICANO 190ML REF 2010",
            "descricao" => "COPO NADIR AMERICANO 190ML REF 2010",
            "descricao_detalhada" => "COPO NADIR AMERICANO 190ML REF 2010",
            "ean" => 40270227,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/40270227.png",
            "ncm" => "70133700.",
            "situacao" => 1,
            "departamentos_id" => 2,
            "secoes_id" => 3,
            "qt_caixa" => 24
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "REFRI COCA COLA 2L",
            "descricao" => "REFRI COCA COLA 2L",
            "descricao_detalhada" => "REFRI COCA COLA 2L",
            "ean" => 7894900011517,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7894900011517.png",
            "ncm" => 22021000623,
            "situacao" => 1,
            "departamentos_id" => 1,
            "secoes_id" => 1,
            "qt_caixa" => 9
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "MAC ESPAGUETE C/OVOS ADRIA N8 500G",
            "descricao" => "MAC ESPAGUETE C/OVOS ADRIA N8 500G",
            "descricao_detalhada" => "MAC ESPAGUETE C/OVOS ADRIA N8 500G",
            "ean" => 7896205788040,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896205788040.png",
            "ncm" => "19021100.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 11,
            "qt_caixa" => 40
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "LAVA ROUPAS PO TIXAN YPE PRIMAVERA 1KG",
            "descricao" => "LAVA ROUPAS PO TIXAN YPE PRIMAVERA 1KG",
            "descricao_detalhada" => "LAVA ROUPAS PO TIXAN YPE PRIMAVERA 1KG",
            "ean" => 7896098900710,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896098900710.png",
            "ncm" => 34022000.12,
            "situacao" => 1,
            "departamentos_id" => 4,
            "secoes_id" => 8,
            "qt_caixa" => 20
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "FERM PO ROYAL QUIMICO 250G",
            "descricao" => "FERM PO ROYAL QUIMICO 250G",
            "descricao_detalhada" => "FERM PO ROYAL QUIMICO 250G",
            "ean" => 7622300119652,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7622300119652.png",
            "ncm" => "17049020.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 11,
            "qt_caixa" => 6
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "LEITE COND SEMIDES PIRACANJUBA 395G",
            "descricao" => "LEITE COND SEMIDES PIRACANJUBA 395G",
            "descricao_detalhada" => "LEITE COND SEMIDES PIRACANJUBA 395G",
            "ean" => 7898215152002,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7898215152002.png",
            "ncm" => "04029900.1",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 10,
            "qt_caixa" => 48
        ]);



        //Teste
        DB::table('tb_produtos')->insert([
            "titulo" => "SALGADINHO AMENDUPA CALABRESA",
            "descricao" => "SALGADINHO AMENDUPA CALABRESA",
            "descricao_detalhada" => "SALGADINHO AMENDUPA CALABRESA",
            "ean" => 7897115103114,
            "unidade" => "UN",
            "url_imagem" => "Mze-produtos/7897115103114.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "SALGADINHO DE BATATA CHURRASCO PRINGLES TUBO 120G",
            "descricao" => "SALGADINHO DE BATATA CHURRASCO PRINGLES TUBO 120G",
            "descricao_detalhada" => "SALGADINHO DE BATATA CHURRASCO PRINGLES TUBO 120G",
            "ean" => 7896004006956,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896004006956.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "CHOCOLATE MEIO AMARGO COM AM�NDOAS GAROTO TALENTO PACOTE 90G",
            "descricao" => "CHOCOLATE MEIO AMARGO COM AM�NDOAS GAROTO TALENTO PACOTE 90G",
            "descricao_detalhada" => "CHOCOLATE MEIO AMARGO COM AM�NDOAS GAROTO TALENTO PACOTE 90G",
            "ean" => 7891008097535,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891008097535.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "AMENDUPA CHURRASCO",
            "descricao" => "AMENDUPA CHURRASCO",
            "descricao_detalhada" => "AMENDUPA CHURRASCO",
            "ean" => 7897115103077,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7897115103077.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "SALGAD AMENDUPA BANCON",
            "descricao" => "SALGAD AMENDUPA BANCON",
            "descricao_detalhada" => "SALGAD AMENDUPA BANCON",
            "ean" => 7897115103084,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7897115103084.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "SNACK DE TRIGO PRESUNTO DEFUMADO EQLIBRI PANETINI PACOTE 40G",
            "descricao" => "SNACK DE TRIGO PRESUNTO DEFUMADO EQLIBRI PANETINI PACOTE 40G",
            "descricao_detalhada" => "SNACK DE TRIGO PRESUNTO DEFUMADO EQLIBRI PANETINI PACOTE 40G",
            "ean" => 7892840267841,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7892840267841.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "BOMBOM PREST�GIO PACOTE 33G",
            "descricao" => "BOMBOM PREST�GIO PACOTE 33G",
            "descricao_detalhada" => "BOMBOM PREST�GIO PACOTE 33G",
            "ean" => 7891000460207,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891000460207.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "WAFER KITKAT PACOTE 41,5G",
            "descricao" => "WAFER KITKAT PACOTE 41,5G",
            "descricao_detalhada" => "WAFER KITKAT PACOTE 41,5G",
            "ean" => 7891000248768,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7891000248768.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "SALGADINHO DE BATATA ORIGINAL PRINGLES TUBO 114G",
            "descricao" => "SALGADINHO DE BATATA ORIGINAL PRINGLES TUBO 114G",
            "descricao_detalhada" => "SALGADINHO DE BATATA ORIGINAL PRINGLES TUBO 114G",
            "ean" => 7896004006482,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7896004006482.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
        DB::table('tb_produtos')->insert([
            "titulo" => "BATATA FRITA ONDULADA ORIGINAL ELMA CHIPS RUFFLES PACOTE 57G",
            "descricao" => "BATATA FRITA ONDULADA ORIGINAL ELMA CHIPS RUFFLES PACOTE 57G",
            "descricao_detalhada" => "BATATA FRITA ONDULADA ORIGINAL ELMA CHIPS RUFFLES PACOTE 57G",
            "ean" => 7892840253844,
            "unidade" => "UN",
            "url_imagem" => "mze-produtos/7892840253844.png",
            "ncm" => "04062000.",
            "situacao" => 1,
            "departamentos_id" => 5,
            "secoes_id" => 9,
            "qt_caixa" => 4
        ]);
    }
}
