<?php

namespace App\Http\Controllers\SIGSAS\Domicilio;

use App\Classes\GeneralFunctions;
use App\Models\SIGSAS\Domicilios\Calle;
use App\Models\SIGSAS\Domicilios\Colonia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SIGSAS\Domicilios\Codigopostal;
use App\Http\Requests\SIGSAS\Domicilio\UbicacionRequest;
use App\Models\SIGSAS\Domicilios\Ubicacion;
use App\Models\SIGSAS\Domicilios\Comunidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class UbicacionController extends Controller
{


    protected $tableName = "ubicaciones";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Ubicacion::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('SIGSAS.Domicilio.ubicacion.ubicacion_list',
            [
                'items'           => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => '',
                'user'            => $user,
                'searchInList'    => 'listUbicaciones',
                'newWindow'       => true,
                'tableName'       => $this->tableName,
                'showEdit'        => 'editUbicacion',
                'newItem'         => 'newUbicacion',
                'removeItem'      => 'removeUbicacion',
                'exportModel'     => 1,
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id){
        $item            = Ubicacion::find($Id);

        $Calles          = Calle::all()->sortBy('calle')->pluck('calle','id');
        $Colonias        = Colonia::all()->sortBy('colonia')->pluck('colonia','id');
        $Comunidades     = Comunidad::all()->sortBy('comunidad')->pluck('comunidad','id');
        $Codigospostales = Codigopostal::all()->sortBy('cp')->pluck('cp','id');

        return view('SIGSAS.Domicilio.ubicacion.ubicacion_edit',
            [
                'user' => Auth::user(),
                'calles'          => $Calles,
                'colonias'        => $Colonias,
                'comunidades'     => $Comunidades,
                'codigospostales' => $Codigospostales,
                'items'           => $item,
                'editItemTitle'   => isset($item->ubicacion) ? $item->ubicacion : 'Nuevo',
                'putEdit'         => 'updateUbicacion',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(UbicacionRequest $request)
    {
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(405);
        }
        return Redirect::to('listUbicaciones');
    }

    protected function updateItemV2(UbicacionRequest $request)
    {
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(405);
        }
        return Redirect::to('editUbicacion',['Id'=>$request->all('id')]);
    }

    protected function newItem()
    {
        $Calles          = Calle::all()->sortBy('calle');
        $Colonias        = Colonia::all()->sortBy('colonia');
        $Comunidades     = Comunidad::all()->sortBy('comunidad');
        $Codigospostales = Codigopostal::all()->sortBy('cp');
        return view('SIGSAS.Domicilio.ubicacion.ubicacion_new',
            [
                'editItemTitle'   => 'Nuevo',
                'calles'          => $Calles,
                'colonias'        => $Colonias,
                'comunidades'     => $Comunidades,
                'codigospostales' => $Codigospostales,
                'postNew'         => 'createUbicacion',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro',
            ]
        );
    }

    protected function newItemV2()
    {
        $Calles          = Calle::all()->sortBy('calle');
        $Colonias        = Colonia::all()->sortBy('colonia');
        $Comunidades     = Comunidad::all()->sortBy('comunidad');
        $Codigospostales = Codigopostal::all()->sortBy('cp');
        $user            = Auth::user();

        return view('SIGSAS.Domicilio.ubicacion.ubicacion_new',
            [
                'calles'          => $Calles,
                'colonias'        => $Colonias,
                'comunidades'     => $Comunidades,
                'codigospostales' => $Codigospostales,
                'Method'          => 'POST',
                'Route'           => 'createUbicacionV2',
                'items_forms'     => 'SIGSAS.Domicilio.ubicacion.__ubicacion.__ubicacion_new',
                'IsNew'           => true,
                'user'            => $user,
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(UbicacionRequest $request)
    {
        $item = $request->manage();
        //dd($item);
        if (!isset($item->id)) {
            abort(404);
        }
        return Redirect::to('listUbicaciones');
    }

    protected function createItemV2(UbicacionRequest $request)
    {
        $Obj = $request->manage();
        if (!is_object($Obj)) {
            $id = 0;
            return redirect('newUbicacionV2')
                ->withErrors($Obj)
                ->withInput();
        }else{
            $id = $Obj->id;
        }
        return Response::json(['mensaje' => 'Dato agregado con éxito', 'data' => 'OK', 'status' => '200'], 200);
    }




// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function searchAdress(Request $request)
    {
        ini_set('max_execution_time', 300000);
        $filters =$request->input('search');
        $F           = new GeneralFunctions();
        $tsString    = $F->string_to_tsQuery( strtoupper($filters),' & ');
        $items = Ubicacion::query()
            ->search($tsString)
            ->orderBy('id')
            ->get();

        $data=array();

        foreach ($items as $item) {
            $data[]=array('value'=>$item->calle.' '.$item->num_ext.' '.$item->num_int.' '.$item->colonia.' '.$item->comunidad,' '.$item->ciudad,'id'=>$item->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No se encontraron resultados','id'=>0];
    }

// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function getUbi($IdUbi=0)
    {
        $items = Ubicacion::find($IdUbi);
        return Response::json(['mensaje' => 'OK', 'data' => json_decode($items), 'status' => '200'], 200);

    }





// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Ubicacion::withTrashed()->findOrFail($id);
        if (isset($item)) {
            if (!$item->trashed()) {
                $item->forceDelete();
            } else {
                $item->forceDelete();
            }
            return Response::json(['mensaje' => 'Registro eliminado con éxito', 'data' => 'OK', 'status' => '200'], 200);
        } else {
            return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
        }
    }







}
