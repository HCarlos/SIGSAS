<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiciosView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        DB::statement("Create or Replace View _viServicios As
            SELECT
                s.id,
                s.servicio,
                s.habilitado,
                s.medida_id,
                s.subarea_id,
                sa.subarea,
                sa.abreviatura as abreviatura_subarea,
                CONCAT(u1.ap_paterno,' ',u1.ap_materno,' ',u1.nombre) AS jefe_subarea,
                sa.area_id,
                a.area,
                a.abreviatura as abreviatura_area,
                CONCAT(u2.ap_paterno,' ',u2.ap_materno,' ',u2.nombre) AS jefe_area,
                a.dependencia_id,
                d.dependencia,
                d.abreviatura as abreviatura_dependencia,
                CONCAT(u3.ap_paterno,' ',u3.ap_materno,' ',u3.nombre) AS jefe_dependencia,
                s.orden_impresion,
                s.estatus_cve
            FROM servicios s
            Left Join subareas sa
                On s.subarea_id = sa.id
                Left Join users u1
                    On sa.jefe_id = u1.id
            Left Join areas a
                On sa.area_id = a.id
                Left Join users u2
                    On a.jefe_id = u2.id
            Left Join dependencias d
                On a.dependencia_id = d.id
                Left Join users u3
                    On d.jefe_id = u3.id
            ");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        DB::statement('DROP VIEW IF EXISTS _viServicios');
    }
}
