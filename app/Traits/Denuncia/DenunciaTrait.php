<?php
/**
 * Copyright (c) 2018. Realizado por Carlos Hidalgo
 */

/**
 * Created by PhpStorm.
 * User: devch
 * Date: 27/11/18
 * Time: 05:50 PM
 */

namespace App\Traits\Denuncia;


use App\Models\SIGSAS\Domicilios\Calle;
use App\Models\SIGSAS\Domicilios\Ciudad;
use App\Models\SIGSAS\Domicilios\Codigopostal;
use App\Models\SIGSAS\Domicilios\Colonia;
use App\Models\SIGSAS\Domicilios\Comunidad;
use App\Models\SIGSAS\Domicilios\Estado;
use App\Models\SIGSAS\Domicilios\Municipio;
use App\Models\SIGSAS\Domicilios\Ubicacion;
use App\Models\User;

trait DenunciaTrait
{

    public function getFullUbicationAttribute(){
        return $this->calle.' '.
            $this->num_ext.' '.
            $this->num_int.' '.
            $this->colonia.' '.
            $this->comunidad.' '.
            $this->ciudad.' '.
            $this->municipio.' '.
            $this->estado.' '.
            $this->cp;
    }

    public function getFechaIngresoSolicitudAttribute(){
        return  $this->fecha_ingreso->format('d-m-Y H:i:s');;
    }

    public function getFolioDacAttribute(){
        return "DAC-".str_pad($this->id,6,'0',STR_PAD_LEFT)."-".$this->fecha_ingreso->format('y');
    }


    public function getUltimoEstatusAttribute(){
        if ( $this->ultimo_estatu_denuncia_dependencia_servicio->count() > 0){
            return $this->ultimo_estatu_denuncia_dependencia_servicio->sortByDesc('id')->first()->estatu->estatus;
        }else{
            return 'Error en Denuncia -> Estatus';
        }
    }

    public function getUltimaFechaEstatusAttribute(){
        if ( $this->ultimo_estatu_denuncia_dependencia_servicio->count() > 0){
            $FechaMovto =  $this->ultimo_estatu_denuncia_dependencia_servicio->sortByDesc('id')->first()->fecha_movimiento;
            return date_format($FechaMovto,'d-m-Y');
        }else{
            return 'Error en Denuncia -> Estatus';
        }
    }

    public function getTotalRespuestasAttribute(){
        $r = $this->denuncia_estatus()->count();
        return $r == 1 ? '' : $r-1;
    }




}
