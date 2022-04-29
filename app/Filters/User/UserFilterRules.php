<?php

namespace App\Filters\User;

class UserFilterRules
{


    /* *****************************************************************************************************************
    *                                       FILTROS DE P E R S O N A S                                                 *
    ***************************************************************************************************************** */

    public function filterRulesLibro(Request $request){
        $data = $request->all(['Id','search','searchbook','titulo','autor','datos_fijos','codebar','isbn','observaciones']);

        $data['Id']         = $data['Id'] == null ? "" : intval($data['Id']);

        $data['search']      = $data['search']     == null ? "" : $data['search'];
        $data['searchbook']  = $data['searchbook'] == null ? "" : $data['searchbook'];
        $data['titulo']      = $data['titulo']     == null ? "" : strtoupper(trim($data['titulo']));
        $data['autor']       = $data['autor']      == null ? "" : strtoupper(trim($data['autor']));

        $data['datos_fijos']     = $data['datos_fijos']   == null ? "" : strtoupper(trim($data['datos_fijos']));
        $data['codebar']         = $data['codebar']       == null ? "" : strtoupper(trim($data['codebar']));
        $data['isbn']            = $data['isbn']          == null ? "" : strtoupper(trim($data['isbn']));
        $data['observaciones']   = $data['observaciones'] == null ? "" : strtoupper(trim($data['observaciones']));

        $filters = [
            'Id'            => $data['Id'],
            'search'        => $data['search'],
            'searchbook'    => $data['searchbook'],
            'titulo'        => $data['titulo'],
            'autor'         => $data['autor'],
            'datos_fijos'   => $data['datos_fijos'],
            'codebar'       => $data['codebar'],
            'isbn'          => $data['isbn'],
            'observaciones' => $data['observaciones'],
        ];
        return $filters;
    }




    public function filterRulesUser(Request $request){
        $data = $request->all(['Id','search','IdP','ap_paterno','ap_materno','nombre','curp','curp10','calle','num_ext','localidad','cp','estado_id','municipio_id','fecha_inicial','fecha_final','fecha_nacimiento','role_id']);

        $fi = !is_null($data['fecha_inicial']) ? Carbon::createFromFormat('Y-m-d',$data['fecha_inicial']) : null ;
        $ff = !is_null($data['fecha_final'])   ? Carbon::createFromFormat('Y-m-d',$data['fecha_final'])   : null ;
        $fn = !is_null($data['fecha_nacimiento'])   ? Carbon::createFromFormat('Y-m-d',$data['fecha_nacimiento'])   : null ;

        $data['IdP']           = $data['IdP']==null       ? "" : intval($data['IdP']);
        $data['search']        = $data['search']==null     ? "" : $data['search'];
        $data['ap_paterno']    = $data['ap_paterno']==null ? "" : $data['ap_paterno'];
        $data['ap_materno']    = $data['ap_materno']==null ? "" : $data['ap_materno'];
        $data['nombre']        = $data['nombre']==null     ? "" : $data['nombre'];
        $data['curp']          = $data['curp']==null       ? "" : $data['curp'];
        $data['curp10']        = $data['curp10']==null     ? "" : $data['curp10'];
        $data['calle']         = $data['calle']==null      ? "" : $data['calle'];
        $data['num_ext']       = $data['num_ext']==null    ? "" : $data['num_ext'];
        $data['localidad']     = $data['localidad']==null  ? "" : $data['localidad'];
        $data['cp']            = $data['cp']==null         ? "" : $data['cp'];
        $data['fecha_inicial'] = $fi ;
        $data['fecha_final']   = $ff ;
        $data['fecha_nacimiento'] = $fn ;
        $data['estado_id']     = $data['estado_id']=="0"    || $data['estado_id']==null    ? "" : intval($data['estado_id']);
        $data['municipio_id']  = $data['municipio_id']=="0" || $data['municipio_id']==null ? "" : intval($data['municipio_id']);

        $filters = [
            'IdP'           => $data['IdP'],
            'search'        => $data['search'],
            'ap_paterno'    => $data['ap_paterno'],
            'ap_materno'    => $data['ap_materno'],
            'nombre'        => $data['nombre'],
            'curp'          => $data['curp'],
            'curp10'        => $data['curp10'],
            'cp'            => $data['cp'],
            'calle'         => $data['calle'],
            'num_ext'       => $data['num_ext'],
            'localidad'     => $data['localidad'],
            'estado_id'     => $data['estado_id'],
            'municipio_id'  => $data['municipio_id'],
            'fecha_inicial' => $data['fecha_inicial'],
            'fecha_final'   => $data['fecha_final'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
        ];
        return $filters;
    }




    public function filterRulesUserDB(Request $request){
        $data = $request->all(['Id','search','IdP','ap_paterno','ap_materno','nombre','cp','curp','curp10','calle','num_ext','localidad','estado_id','municipio_id','fecha_inicial','fecha_final','fecha_nacimiento','role_id','user_id_anterior']);

        $fi = !is_null($data['fecha_inicial']) ? Carbon::createFromFormat('Y-m-d',$data['fecha_inicial'])->toDateString() : null ;
        $ff = !is_null($data['fecha_final'])   ? Carbon::createFromFormat('Y-m-d',$data['fecha_final'])->toDateString()   : null ;
        $fn = !is_null($data['fecha_nacimiento'])   ? Carbon::createFromFormat('Y-m-d',$data['fecha_nacimiento'])->toDateString()   : null ;

        $data['IdP']              = $data['IdP']==null    ? "" : intval($data['IdP']);
        $data['search']           = $data['search']==null ? "" : $data['search'];
        $data['role_id']          = $data['role_id']==null ? "" : $data['role_id'];
        $data['user_id_anterior'] = $data['user_id_anterior']==null ? "" : $data['user_id_anterior'];

        $data['ap_paterno'] = $data['ap_paterno']==null || $data['ap_paterno']==""  ? "" : strtoupper(trim($data['ap_paterno']));
        $data['ap_materno'] = $data['ap_materno']==null || $data['ap_materno']==""  ? "" : strtoupper(trim($data['ap_materno']));
        $data['nombre']     = $data['nombre']==null     || $data['nombre']==""      ? "" : strtoupper(trim($data['nombre']));
        $data['curp']       = $data['curp']==null       || $data['curp']==""        ? "" : strtoupper(trim($data['curp']));
        $data['curp10']     = $data['curp10']==null     || $data['curp10']==""      ? "" : strtoupper(trim($data['curp10']));
        $data['cp']         = $data['cp']==null         || $data['cp']==""          ? "" : strtoupper(trim($data['cp']));
        $data['calle']      = $data['calle']==null      || $data['calle']==""       ? "" : strtoupper(trim($data['calle']));
        $data['num_ext']    = $data['num_ext']==null    || $data['num_ext']==""     ? "" : strtoupper(trim($data['num_ext']));
        $data['localidad']  = $data['localidad']==null  || $data['localidad']==""   ? "" : strtoupper(trim($data['localidad']));

        $data['fecha_inicial'] = $fi == null ? "" : $fi;
        $data['fecha_final']   = $ff == null ? "" : $ff;

        $data['estado_id']    = $data['estado_id']=="0"    || $data['estado_id']==null    ? "" : intval($data['estado_id']);
        $data['municipio_id'] = $data['municipio_id']=="0" || $data['municipio_id']==null ? "" : intval($data['municipio_id']);

        $filters = [
            'Id'               => $data['Id'],
            'IdP'              => $data['IdP'],
            'search'           => $data['search'],
            'ap_paterno'       => $data['ap_paterno'],
            'ap_materno'       => $data['ap_materno'],
            'nombre'           => $data['nombre'],
            'curp'             => $data['curp'],
            'curp10'           => $data['curp10'],
            'fecha_inicial'    => $data['fecha_inicial'],
            'fecha_final'      => $data['fecha_final'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'cp'               => $data['cp'],
            'calle'            => $data['calle'],
            'num_ext'          => $data['num_ext'],
            'localidad'        => $data['localidad'],
            'estado_id'        => $data['estado_id'],
            'municipio_id'     => $data['municipio_id'],
            'role_id'          => $data['role_id'],
            'user_id_anterior' => $data['user_id_anterior'],
        ];
        return $filters;
    }




}
