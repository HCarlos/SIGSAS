<?php

namespace App\Http\Controllers\SIGSAS\Domicilio;

//use App\Models\SIGSAS\Domicilios\Calle;
use App\Models\SIGSAS\Domicilios\Codigopostal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SIGSAS\Domicilio\ColoniaRequest;
use App\Models\SIGSAS\Domicilios\Colonia;
use App\Models\SIGSAS\Domicilios\Comunidad;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class ColoniaController extends Controller
{


    protected $tableName = "colonias";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Colonia::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('SIGSAS.Domicilio.colonia.colonia_list',
            [
                'items'           => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => ' ',
                'user'            => $user,
                'searchInList'    => 'listColonias',
                'newWindow'       => true,
                'tableName'       => $this->tableName,
                'showEdit'        => 'editColonia',
                'newItem'         => 'newColonia',
                'removeItem'      => 'removeColonia',
                'exportModel' => 11,
            ]
        );
    }

// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item = Colonia::find($Id);
        $Codigospostales =Codigopostal::all(['id','cp'])->sortBy('cp');
        $Comunidades = Comunidad::all(['id','comunidad'])->sortBy('comunidad');

        return view('SIGSAS.Domicilio.colonia.colonia_edit',
            [
                'user'            => Auth::user(),
                'codigospostales' => $Codigospostales,
                'comunidades'     => $Comunidades,
                'items'           => $item,
                'editItemTitle'   => isset($item->colonia) ? $item->colonia : 'Nuevo',
                'putEdit'         => 'updateColonia',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

// ***************** GUARDA LOS CAMBIOS ++++++++++++++++++++ //
    protected function updateItem(ColoniaRequest $request)
    {
        $item = $request->manage();
        if (!isset($item->id)) {
            abort(405);
        }
        return Redirect::to('listColonias');
    }

    protected function newItem()
    {
        $Codigospostales =Codigopostal::all(['id','cp'])->sortBy('cp');
        $Comunidades = Comunidad::all(['id','comunidad'])->sortBy('comunidad');
        //dd($Codigospostales);
        return view('SIGSAS.Domicilio.colonia.colonia_new',
            [
                'editItemTitle'   => 'Nuevo',
                'codigospostales' => $Codigospostales,
                'comunidades'     => $Comunidades,
                'postNew'         => 'createColonia',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro ',
            ]
        );
    }

    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function createItem(ColoniaRequest $request){
        //dd($request);
        $item = $request->manage();
        //dd($item);
        if (!isset($item->id)) {
            //abort(404);
        }
        return Redirect::to('listColonias');
    }



// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function buscarColonia(Request $request)
    {
        ini_set('max_execution_time', 300000);
        $filters = $request->all(['search']);
        $items = Colonia::query()
            ->filterBy($filters)
            ->orderBy('id')
            ->get();

        $data=array();

        foreach ($items as $item) {
            $data[]=array('value'=>$item->colonia,'id'=>$item->id);
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No se encontraron calles','id'=>0];

    }

// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function getColonia($IdColonia=0)
    {
        $items = Colonia::find($IdColonia);
        return Response::json(['mensaje' => 'OK', 'data' => json_decode($items), 'status' => '200'], 200);

    }










// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Colonia::withTrashed()->findOrFail($id);
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
