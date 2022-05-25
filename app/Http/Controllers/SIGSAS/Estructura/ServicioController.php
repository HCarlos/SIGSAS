<?php

namespace App\Http\Controllers\SIGSAS\Estructura;

use App\Classes\RemoveItemSafe;
use App\Http\Requests\SIGSAS\Denuncia\ServicioRequest;
use App\Models\SIGSAS\Estructura\Medida;
use App\Models\SIGSAS\Estructura\Servicio;
use App\Models\SIGSAS\Estructura\Subarea;
use App\Models\SIGSAS\Denuncias\Denuncia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

class ServicioController extends Controller
{

    protected $tableName = "Servicios";

// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //
    protected function index(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters = $request->all(['search']);
        $items = Servicio::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate();
        $items->appends($filters)->fragment('table');
        $user = Auth::User();

        return view('SIGSAS.Estructura.servicio.servicio_list',
            [
                'items'           => $items,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => '',
                'user'            => $user,
                'searchInList'    => 'listServicios',
                'newWindow'       => true,
                'tableName'       => $this->tableName,
                'showEdit'        => 'editServicioV2',
                'newItem'         => 'newServicioV2',
                'removeItem'      => 'removeServicio',
                'IsModal'         => true,
                'exportModel'     => 2,
            ]
        );
    }


    // ***************** CREAR NUEVO ++++++++++++++++++++ //
    protected function newItem()
    {
        $medidas = Medida::all(['id','medida'])->sortBy('medida');
        $subareas = Subarea::all()->sortBy('subarea');
        return view('SIGSAS.Estructura.servicio.servicio_new',
            [
                'editItemTitle' => 'Nuevo',
                'postNew' => 'createServicio',
                'medidas' => $medidas,
                'subareas' => $subareas,
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Nuevo registro',
            ]
        );
    }

    protected function createItem(ServicioRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('listServicios');
    }


    // ***************** CREAR NUEVO MODAL ++++++++++++++++++++ //
    protected function newItemV2()
    {
        $medidas = Medida::all(['id','medida'])->sortBy('medida');
        $subareas = Subarea::all()->sortBy('subarea');
        $user = Auth::user();
        return view('SIGSAS.Estructura.servicio.servicio_modal',
            [
                'Titulo'      => 'Nuevo',
                'Route'       => 'createServicioV2',
                'Method'      => 'POST',
                'items_forms' => 'SIGSAS.Estructura.servicio.__servicio.__servicio_new',
                'IsNew'       => true,
                'user'        => $user,
                'medidas'     => $medidas,
                'subareas'    => $subareas,
            ]
        );
    }

    protected function createItemV2(ServicioRequest $request)
    {
        $Obj = $request->manage();
        if (!is_object($Obj)) {
            $id = 0;
            return redirect('newServicioV2')
                ->withErrors($Obj)
                ->withInput();
        }else{
            $id = $Obj->id;
        }
        return Response::json(['mensaje' => 'Dato agregado con éxito', 'data' => 'OK', 'status' => '200'], 200);
    }



// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItem($Id)
    {
        $item = Servicio::find($Id);
        $medidas = Medida::all(['id','medida'])->sortBy('medida');
        $subareas = Subarea::all()->sortBy('subarea');
        //dd($item);
        return view('SIGSAS.Estructura.servicio.servicio_edit',
            [
                'user'            => Auth::user(),
                'items'           => $item,
                'medidas'         => $medidas,
                'subareas'        => $subareas,
                'editItemTitle'   => $item->categoria ?? 'Nuevo',
                'putEdit'         => 'updateServicio',
                'titulo_catalogo' => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'   => 'Editando el Folio '.$Id,
            ]
        );
    }

    protected function updateItem(ServicioRequest $request)
    {
        $item = $request->manage();
        if (!isset($item)) {
            abort(404);
        }
        return Redirect::to('listServicios');
    }


// ***************** EDITA LOS DATOS  ++++++++++++++++++++ //
    protected function editItemV2($Id)
    {
        $item = Servicio::find($Id);
        $medidas = Medida::all(['id','medida'])->sortBy('medida');
        $subareas = Subarea::all()->sortBy('subarea');
        $user = Auth::user();
        return view('SIGSAS.Estructura.servicio.servicio_modal',
            [
                'Titulo'      => $item->prioridad ?? 'Nuevo',
                'Route'       => 'updateServicioV2',
                'Method'      => 'POST',
                'items'       => $item,
                'items_forms' => 'SIGSAS.Estructura.servicio.__servicio.__servicio_edit',
                'IsNew'       => false,
                'IsModal'     => true,
                'user'        => $user,
                'medidas'     => $medidas,
                'subareas'    => $subareas,
            ]
        );
    }

    protected function updateItemV2(ServicioRequest $request)
    {
        $Obj = $request->manage();
        if (!is_object($Obj)) {
            $id = 0;
            return redirect('editServicioV2')
                ->withErrors($Obj)
                ->withInput();
        }else{
            $id = $Obj->id;
        }
        return Response::json(['mensaje' => 'Dato agregado con éxito', 'data' => 'OK', 'status' => '200'], 200);
    }


// ***************** ELIMINA EL ITEM VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($id = 0)
    {
        $item = Servicio::withTrashed()->findOrFail($id);
        if (isset($item)) {
            return RemoveItemSafe::RemoveItemObject($item,'servicio_id',$id);
        } else {
            return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
        }
    }


}
