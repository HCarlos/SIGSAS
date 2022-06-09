<?php
/**
 * Created by PhpStorm.
 * User: devch
 * Date: 21/11/18
 * Time: 06:36 PM
 */

namespace App\Classes;


//use App\Models\User;
use Illuminate\Http\Request;
//use App\Role;
use Illuminate\Support\Facades\Auth;

class FiltersRules
{

    public function filterRulesDenuncia(Request $request){
        $data = $request->all(['curp','ciudadano','id','desde','hasta','dependencia_id','servicio_id','estatus_id','creadopor_id','incluirFecha','conRespuesta']);
        $data['curp']           = $data['curp']           == null ? "" : $data['curp'];
        $data['ciudadano']      = $data['ciudadano']      == null ? "" : $data['ciudadano'];
        $data['id']             = $data['id']             == null ? "" : $data['id'];
        $data['desde']          = $data['desde']          == null ? "" : $data['desde'];
        $data['hasta']          = $data['hasta']          == null ? "" : $data['hasta'];
        $data['incluirFecha']   = $data['incluirFecha']   == null ? "" : $data['incluirFecha'];
        $data['conRespuesta']   = $data['conRespuesta']   == null ? "" : $data['conRespuesta'];

        $data['dependencia_id'] = $data['dependencia_id'] == null ? "" : $data['dependencia_id'];

        $data['servicio_id']    = $data['servicio_id']    == null ? "" : $data['servicio_id'];
        $data['estatus_id']     = $data['estatus_id']     == null ? "" : $data['estatus_id'];
        $data['creadopor_id']   = $data['creadopor_id']   == null ? "" : $data['creadopor_id'];
        $filters = [
            'curp'           => $data['curp'],
            'ciudadano'      => $data['ciudadano'],
            'id'             => $data['id'],
        ];
        if ($data['incluirFecha'] != null){
            $filters = array_merge($filters, ['desde' => $data['desde'], 'hasta' => $data['hasta'] ] );
        }
        $filters = array_merge($filters, [
            'dependencia_id' => $data['dependencia_id'],
            'servicio_id'    => $data['servicio_id'],
            'estatus_id'     => $data['estatus_id'],
            'creadopor_id'   => $data['creadopor_id'],
            'conrespuesta'   => $data['conRespuesta'],
        ]);

//        dd($filters);

        return $filters;
    }

}
