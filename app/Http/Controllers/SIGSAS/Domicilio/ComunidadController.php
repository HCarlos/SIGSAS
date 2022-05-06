<?php

namespace App\Http\Controllers\SIGSAS\Domicilio;

use App\Classes\GeneralFunctions;
use App\Http\Requests\SIGSAS\Domicilio\ComunidadRequest;
use App\Models\SIGSAS\Domicilios\Ciudad;
//use App\Models\SIGSAS\Domicilios\Codigopostal;
//use App\Models\SIGSAS\Domicilios\Comunidad;
use App\Models\SIGSAS\Domicilios\Comunidad;
use App\Models\SIGSAS\Domicilios\Estado;
use App\Models\SIGSAS\Domicilios\Municipio;
use App\Models\SIGSAS\Domicilios\Tipocomunidad;
use App\Traits\Catalogos\Domicilio\Comunidad\ComunidadTrait;
use App\Traits\Common\CommonTrait;
//use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class ComunidadController extends Controller
{
    use ComunidadTrait, CommonTrait;

    protected $tableName  = "comunidades";
    protected $Ciudades        = [];
    protected $Municipios      = [];
    protected $Estados         = [];
    protected $Ciudad_Id       = [];
    protected $Municipio_Id    = [];
    protected $Estado_Id       = [];
    protected $Delegados       = [];
    protected $Tipocomunidades = [];

    protected $F               = null;



// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //

    public function __construct(){

        $this->middleware('auth');

        $this->tableName = "comunidades";

        $this->Ciudades        = Ciudad::all()->sortBy('ciudad');
        $this->Municipios      = Municipio::all()->sortBy('municipio');
        $this->Estados         = Estado::all()->sortBy('estado');

        $this->Ciudad_Id       = Ciudad::all()->where('ciudad',config('atemun.ciudad_default'))->first();
        $this->Municipio_Id    = Municipio::all()->where('municipio',config('atemun.municipio_default'))->first();
        $this->Estado_Id       = Estado::all()->where('estado',config('atemun.estado_default'))->first();

        $this->Delegados       = $this->getUserFromRoles('DELEGADO');
        $this->Tipocomunidades = Tipocomunidad::all(['id','tipocomunidad'])->sortBy('tipocomunidad');

        $this->F = new GeneralFunctions();

    }

    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Comunidad::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('SIGSAS.Domicilio.comunidad.comunidad_list',
            [
                'items'           => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => '',
                'user'            => $user,
                'searchInList'    => 'listComunidades',
                'newWindow'       => true,
                'tableName'       => $this->tableName,
                'showEdit'        => 'editComunidadV2',
                'newItem'         => 'newComunidadV2',
                'removeItem'      => 'removeComunidad',
                'IsModal'         => true,
                'exportModel'     => 12,
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function newItem()
    {
//        $Ciudades        = Ciudad::all()->sortBy('ciudad');
//        $Municipios      = Municipio::all()->sortBy('municipio');
//        $Estados         = Estado::all()->sortBy('estado');
//
//        $Ciudad_Id       = Ciudad::all()->where('ciudad',config('atemun.ciudad_default'))->first();
//        $Municipio_Id    = Municipio::all()->where('municipio',config('atemun.municipio_default'))->first();
//        $Estado_Id       = Estado::all()->where('estado',config('atemun.estado_default'))->first();
//
//        $Delegados       = $this->getUserFromRoles('DELEGADO');
//        $Tipocomunidades = Tipocomunidad::all(['id','tipocomunidad'])->sortBy('tipocomunidad');


        return view('SIGSAS.Domicilio.comunidad.comunidad_new',
            [
                'editItemTitle'   => 'Nuevo',
                'delegados'       => $this->Delegados,
                'tipocomunidades' => $this->Tipocomunidades,
                'ciudades'        => $this->Ciudades,
                'municipios'      => $this->Municipios,
                'estados'         => $this->Estados,
                'ciudad_id'       => $this->Ciudad_Id->id,
                'municipio_id'    => $this->Municipio_Id->id,
                'estado_id'       => $this->Estado_Id->id,
                'postNew'         => 'createComunidad',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro ',
            ]
        );
    }

    protected function createItem(ComunidadRequest $request){
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(404);
        }
        return Redirect::to('listComunidades');
    }

    // ***************** CREAR NUEVO MODAL++++++++++++++++++++ //
    protected function newItemV2()
    {
//        $Ciudades        = Ciudad::all()->sortBy('ciudad');
//        $Municipios      = Municipio::all()->sortBy('municipio');
//        $Estados         = Estado::all()->sortBy('estado');
//
//        $Ciudad_Id       = Ciudad::all()->where('ciudad',config('atemun.ciudad_default'))->first();
//        $Municipio_Id    = Municipio::all()->where('municipio',config('atemun.municipio_default'))->first();
//        $Estado_Id       = Estado::all()->where('estado',config('atemun.estado_default'))->first();
//
//        $Delegados       = $this->getUserFromRoles('DELEGADO');
//        $Tipocomunidades = Tipocomunidad::all(['id','tipocomunidad'])->sortBy('tipocomunidad');


        $user = Auth::user();
        return view('SIGSAS.Domicilio.comunidad.comunidad_modal',
            [
                'Titulo'          => 'Nueva',
                'Route'           => 'createComunidadV2',
                'Method'          => 'POST',
                'items_forms'     => 'SIGSAS.Domicilio.comunidad.__comunidad.__comunidad_new',
                'IsNew'           => true,
                'user'            => $user,
                'delegados'       => $this->Delegados,
                'tipocomunidades' => $this->Tipocomunidades,
                'ciudades'        => $this->Ciudades,
                'municipios'      => $this->Municipios,
                'estados'         => $this->Estados,
                'ciudad_id'       => $this->Ciudad_Id->id,
                'municipio_id'    => $this->Municipio_Id->id,
                'estado_id'       => $this->Estado_Id->id,
            ]
        );

    }

    protected function createItemV2(ComunidadRequest $request){
        return $this->F->setSaveItem($request);
    }


// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id){

        $item            = Comunidad::find($Id);

//        $Ciudades        = Ciudad::all()->sortBy('ciudad');
//        $Municipios      = Municipio::all()->sortBy('municipio');
//        $Estados         = Estado::all()->sortBy('estado');
//
//        $Ciudad_Id       = Ciudad::all()->where('ciudad',config('atemun.ciudad_default'))->first();
//        $Municipio_Id    = Municipio::all()->where('municipio',config('atemun.municipio_default'))->first();
//        $Estado_Id       = Estado::all()->where('estado',config('atemun.estado_default'))->first();
//
//        $Delegados       = $this->getUserFromRoles('DELEGADO');
//        $Tipocomunidades = Tipocomunidad::all(['id','tipocomunidad'])->sortBy('tipocomunidad');

        return view('SIGSAS.Domicilio.comunidad.comunidad_edit',
            [
                'user'            => Auth::user(),
                'delegados'       => $this->Delegados,
                'tipocomunidades' => $this->Tipocomunidades,
                'ciudades'        => $this->Ciudades,
                'municipios'      => $this->Municipios,
                'estados'         => $this->Estados,
                'ciudad_id'       => $this->Ciudad_Id->id,
                'municipio_id'    => $this->Municipio_Id->id,
                'estado_id'       => $this->Estado_Id->id,
                'items'           => $item,
                'editItemTitle'   => isset($item->comunidad) ? $item->comunidad : 'Nuevo',
                'putEdit'         => 'updateComunidad',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

    protected function updateItem(ComunidadRequest $request){
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(404);
        }
        return Redirect::to('listComunidades');
    }


// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItemV2($Id){

        $item            = Comunidad::find($Id);

//        $Ciudades        = Ciudad::all()->sortBy('ciudad');
//        $Municipios      = Municipio::all()->sortBy('municipio');
//        $Estados         = Estado::all()->sortBy('estado');
//
//        $Ciudad_Id       = Ciudad::all()->where('ciudad',config('atemun.ciudad_default'))->first();
//        $Municipio_Id    = Municipio::all()->where('municipio',config('atemun.municipio_default'))->first();
//        $Estado_Id       = Estado::all()->where('estado',config('atemun.estado_default'))->first();
//
//        $Delegados       = $this->getUserFromRoles('DELEGADO');
//        $Tipocomunidades = Tipocomunidad::all(['id','tipocomunidad'])->sortBy('tipocomunidad');

        $user = Auth::user();
        return view('SIGSAS.Domicilio.comunidad.comunidad_modal',
            [
                'Titulo'          => 'Nueva',
                'Route'           => 'updateComunidadV2',
                'Method'          => 'POST',
                'items_forms'     => 'SIGSAS.Domicilio.comunidad.__comunidad.__comunidad_edit',
                'IsNew'           => false,
                'IsModal'         => true,
                'items'           => $item,
                'user'            => $user,
                'delegados'       => $this->Delegados,
                'tipocomunidades' => $this->Tipocomunidades,
                'ciudades'        => $this->Ciudades,
                'municipios'      => $this->Municipios,
                'estados'         => $this->Estados,
                'ciudad_id'       => $this->Ciudad_Id->id,
                'municipio_id'    => $this->Municipio_Id->id,
                'estado_id'       => $this->Estado_Id->id,
            ]
        );
    }

    protected function updateItemV2(ComunidadRequest $request){
        return $this->F->setSaveItem($request);
    }






// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function buscarComunidad(Request $request){
        ini_set('max_execution_time', 300000);
        $filters = $request->all(['search']);
        $items = Comunidad::query()
            ->filterBy($filters)
            ->orderBy('id')
            ->get();

        $data=array();

        foreach ($items as $item) {
            $data[]=array('value'=>$item->comunidad,'id'=>$item->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No se encontraron calles','id'=>0];

    }

// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function getComunidad($IdComunidad=0)
    {
        $items = Comunidad::find($IdComunidad);
        return Response::json(['mensaje' => 'OK', 'data' => json_decode($items), 'status' => '200'], 200);

    }





// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0){

        $item = Comunidad::withTrashed()->findOrFail($id);
        if (isset($item)) {
            $item->forceDelete();
            return Response::json(['mensaje' => 'Registro eliminado con éxito', 'data' => 'OK', 'status' => '200'], 200);
        } else {
            return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
        }

    }




}
