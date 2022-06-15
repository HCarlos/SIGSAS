<?php

namespace App\Http\Controllers\SIGSAS\User;

use App\Classes\GeneralFunctions;
use App\Http\Controllers\Controller;
use App\Http\Requests\SIGSAS\User\UserRequest;
use App\Http\Requests\SIGSAS\User\UserUpdatePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;


class UserController extends Controller{




    protected $tableName = "users";
    protected $navCat = "usuarios";
    protected $msg = "";
    protected $max_item_for_query = 250;



// ***************** MUESTRA EL LISTADO DE USUARIOS ++++++++++++++++++++ //

    /**
     * UserController constructor.
     * @param string $msg
     */
    public function __construct(){
        $this->middleware('auth');
    }

    protected function index(Request $request){

        $this->lim_max_reg = config('ibt.limite_maximo_registros');
        $this->lim_min_reg = config('ibt.limite_minimo_registros');
        $this->max_reg_con = config('ibt.maximo_registros_consulta');
        $this->min_reg_con = config('ibt.minimo_registros_consulta');

        @ini_set( 'upload_max_size' , '16384M' );
        @ini_set( 'post_max_size', '16384M');
        @ini_set( 'max_execution_time', '960000' );

        ini_set('max_execution_time', 300);
        $this->tableName = 'usuarios';
        $filters = $request->all(['search', 'roles', 'palabras_roles']);
        $items = User::query()
            ->filterBy($filters)
            ->orderByDesc('id')
            ->paginate($this->max_item_for_query);
        $items->appends($filters)->fragment('table');
        $user = Auth::User();
        $roles = Role::all();
        $this->msg = "";

//        dd( $items );

        return view('SIGSAS.User.user_list',
            [
                'items'              => $items,
                'roles'              => $roles,
                'checkedRoles'       => collect(request('roles')),
                'titulo_catalogo'    => "Catálogo de " . ucwords($this->tableName),
                'titulo_header'      => '',
                'user'               => $user,
                'newWindow'          => true,
                'tableName'          => $this->tableName,
                'editItem'           => 'editUser',
                'updateItem'         => 'updateUser',
                'newItem'            => 'newUser',
                'removeItem'         => 'removeUser',
                'showEditBecas'      => 'showEditBecas',
                'showProcess1'       => 'showFileListUserExcel1A',
                'exportModel'        => 19,
                'msg'                => $this->msg,
                'IsModal'            => false,
                'IsModalEdit'        => false,
                'searchTopBar'       => 'userList',
                'searchTopBarLabels' => 'Ap Paterno, Ap Materno, Nombre, CURP, Username, Email',
            ]
        );


    }

// ***************** EDITA LOS DATOS DEL USUARIO SOLO LECTURA ++++++++++++++++++++ //
    protected function showEditUserData()
    {
        $user = Auth::user();
        $this->msg = "";
        return view('SIGSAS.User.user_profile_solo_lectura',
            [
                'user' => $user,
                'items' => $user,
                'titulo_catalogo' => "Catálogo de Usuarios",
                'titulo_header'   => 'Editando datos',
                'msg'             => $this->msg,
            ]
        );
    }


    protected function newItem(){
        $this->msg = "";
        return view('SIGSAS.User.user_profile_new',
            [
                'titulo_catalogo' => 'Catálogo de Usuarios',
                'titulo_header'   => 'Nuevo Usuario ',
                'postNew'         => 'createUser',
                'msg'             => $this->msg,
            ]
        );

    }

    protected function createItem(UserRequest $request) {

        $Data = $request->all(['id']);
        $Obj = $request->manageUser();

        if (!is_object($Obj)) {
            $id = 0;
            return redirect('newUser')
                ->withErrors($Obj)
                ->withInput();
        }else{
            $id = $Obj->id;
        }

        session(['msg' => $this->msg]);
        $user = is_null($Obj) || trim($Obj) == "" ? User::all()->last() : $Obj;
        $Ubicaciones_Usuario = $user->ubicaciones;

        return view('SIGSAS.User.user_profile_edit',
            [
                'user'              => $user,
                'items'             => $user,
                'titulo_catalogo'   => $user->Fullname ?? '' ,
                'user_address_list' => $Ubicaciones_Usuario,
                'titulo_header'     => 'Editando...',
                'putEdit'           => 'EditUser',
                'msg'               => $this->msg,
            ]
        );

    }


    protected function editItem($Id){

        $user = User::find($Id);
        $Ubicaciones_Usuario = $user->ubicaciones;
        //dd( json_decode( json_encode(  $Ubicaciones_Usuario ) ) );
        $this->msg = "";
        return view('SIGSAS.User.user_profile_edit',
            [
                'user'              => $user,
                'items'             => $user,
                'user_address_list' => $Ubicaciones_Usuario,
                'titulo_catalogo'   => "Catálogo de Usuarios",
                'titulo_header'     => 'Editando el Folio '.$Id,
                'msg'               => $this->msg,
            ]
        );

    }


// ***************** GUARDA LOS CAMBIOS EN EL USUARIO ++++++++++++++++++++ //
    protected function update(UserRequest $request)
    {
        $Obj = $request->manageUser();
        if (!is_object($Obj)) {
            $id = 0;
            return redirect('editUser')
                ->withErrors($Obj)
                ->withInput();
        }else{
            $id = $Obj->id;
        }

        $this->msg = "Registro Guardado con éxito!";
        session(['msg' => $this->msg]);
        return redirect()->route('listUsers');
    }


    protected function updateItem(UserRequest $request) {
        $Data = $request->all(['id']);
        $Obj = $request->manageUser();

        if (!is_object($Obj)) {
            $id = 0;
            return redirect('editUser')
                ->withErrors($Obj)
                ->withInput();
        }else{
            $id = $Obj->id;
        }
        session(['msg' => $this->msg]);
        return redirect()->route('listUsers');
    }

    protected function updateItemV2(UserRequest $request)
    {

        $Data = $request->all(['id']);
        //dd($UserId);
        $user = $request->manageUser();
        if (!isset($user) || !is_object($user)) {
            $this->msg = $user;
            $user = User::find($Data['id']);
        } else {
            $this->msg = "Registro Guardado con éxito!!!";
        }
        session(['msg' => $this->msg]);

        return redirect()->route('editUser', ['Id' => $request->all('id')]);

    }

    // ***************** ELIMINA AL USUARIO VIA AJAX ++++++++++++++++++++ //
    protected function removeItem($Id = 0, $dato1 = null, $dato2 = null){

        If ($id > 3){
            $user = User::withTrashed()->findOrFail($id);
            if (isset($user)) {
                if (!$user->trashed()) {
                    $user->forceDelete();
                } else {
                    $user->forceDelete();
                }
                return Response::json(['mensaje' => 'Registro eliminado con éxito', 'data' => 'OK', 'status' => '200'], 200);
            } else {
                return Response::json(['mensaje' => 'Se ha producido un error.', 'data' => 'Error', 'status' => '200'], 200);
            }
        }else{
            return Response::json(['mensaje' => 'Este usuario no se puede eliminar', 'data' => 'Error', 'status' => '200'], 200);
        }

    }







// ***************** MUESTRA LA EDICIÓMN DE FOTO ++++++++++++++++++++ //
    protected function showEditProfilePhoto()
    {
        $user = Auth::user();
        $titulo_catalogo = "";
        $this->msg = "";
        return view('SIGSAS.User.user_photo_update', [
                "user"            => $user,
                "items"           => $user,
                "titulo_catalogo" => "Catálogo de Usuarios",
                'titulo_header'   => 'Actualizando avatar',
                'msg'             => $this->msg,
            ]
        );
    }


// ***************** MUESTRA LA EDICIÓN DEL PASSWORD ++++++++++++++++++++ //
    protected function showEditProfilePassword()
    {
        $user = Auth::user();
        $titulo_catalogo = "";
        $this->msg = "";
        session(['msg' => $this->msg]);
        return view('SIGSAS.User.user_password_edit', [
                "user"            => $user,
                "items"           => $user,
                "titulo_catalogo" =>"Catálogo de Usuarios",
                'titulo_header'   => 'Actualizando password',
                'msg'             => $this->msg,
            ]
        );
    }

// ***************** CAMBIA EL PASSWORD ++++++++++++++++++++ //
    protected function changePasswordUser(UserUpdatePasswordRequest $request)
    {
        $request->updateUserPassword();
        $titulo_catalogo = "";
        $this->msg = "";
        session(['msg' => $this->msg]);
        return view('SIGSAS.User.user_password_edit', [
            "user"            => Auth::user(),
            "items"           => Auth::user(),
            "msg"             => 'Password cambiado con éxito!',
            "titulo_catalogo" =>"Catálogo de Usuarios",
            'titulo_header'   => 'Editando password',
            'msg'             => $this->msg,
        ]);
    }


// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function searchUser(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters =$request->input('search');
        $F           = new GeneralFunctions();
        $tsString    = $F->string_to_tsQuery( strtoupper($filters),' & ');
        $items = User::query()
            ->search($tsString)
            ->orderBy('id')->take(50)
            ->get();
        $data=array();
        //dd($items);
        foreach ($items as $item) {
            $data[]=array(
                'value'=>$item->fullName.' - '.$item->curp,
                'domicilio'=>$item->ubicaciones()->first()->Ubicacion,
                'telefonos'=>$item->TelefonosCelularesEmails,
                'id'=>$item->id,
            );
        }
        if(count($data))
            return $data;
        else
            return ['value'=>'No se encontraron resultados','id'=>0];

    }

// ***************** MAUTOCOMPLETE DE UBICACIONES ++++++++++++++++++++ //
    protected function getUser($Id=0)
    {
        $items = User::find($Id);
        $items->domicilio = $items->ubicaciones()->first()->Ubicacion;
        $items->ubicacion_id = $items->ubicaciones()->first()->id;
        $items->nombre_completo = $items->FullName;
        $items->telefonos = $items->TelefonosCelularesEmails;
        //dd($items);
        return Response::json(['mensaje' => 'OK', 'data' => json_decode($items), 'status' => '200'], 200);

    }

    protected function getCURP(Request $request)
    {
        ini_set('max_execution_time', 300);
        $filters =$request->input('search');
        //dd($filters);
        $F           = new GeneralFunctions();
        $tsString    = $F->string_to_tsQuery( strtoupper($filters),' & ');
        $data =  User::query()
            ->search($tsString)
            ->orderBy('id')->take(50)
            ->get();

        return Response::json(['mensaje' => 'OK', 'data' => json_decode($data), 'status' => '200'], 200);


    }











//
//
//// ***************** EDITA LOS DATOS DEL USUARIO PARA ESCRITURA ++++++++++++++++++++ //
//    protected function editProfile($Id)
//    {
//
//        $user = User::find($Id);
//        return view('User.profile',
//            [
//                'item'     => $user,
//                'User'     => $user,
//                'titulo'   => 'Mi Perfil',
//                'Route'    => 'updateProfile',
//                'Method'   => 'POST',
//                'msg'      => $this->msg,
//                'ReadOnly' => true,
//            ]
//        );
//    }
//
//// ***************** GUARDA LOS CAMBIOS EN EL USUARIO ++++++++++++++++++++ //
//    protected function updateProfile(UserRequest $request)
//    {
////        dd($request);
//        $request->manageUser();
//        $User = Auth::user();
//        session(['msg' => 'value']);
//        return redirect()->route('editProfile',['Id'=>$User]);
//    }
//
//// ***************** MUESTRA LA EDICIÓMN DE FOTO ++++++++++++++++++++ //
//    protected function editFotodUser()
//    {
//        $user = Auth::user();
//        return view('User.foto', [
//                'User' => $user,
//                'titulo' => 'Cambiar mi foto',
//                'Route' => 'updateFotodUser',
//                'Method' => 'POST',
//                'msg' => $this->msg,
//                'IsUpload' => true,
//                'IsNew' => true,
//            ]
//        );
//    }
//
//// ***************** MUESTRA LA EDICIÓN DEL PASSWORD ++++++++++++++++++++ //
//    protected function editPasswordUser()
//    {
//
//        $user = Auth::user();
//        $titulo_catalogo = "";
//        return view('User.password', [
//                'User' => $user,
//                'titulo' => 'Cambiar mi password',
//                'Route' => 'updatePasswordUser',
//                'Method' => 'POST',
//                'msg' => $this->msg,
//            ]
//        );
//    }
//
//// ***************** CAMBIA EL PASSWORD ++++++++++++++++++++ //
//    protected function updatePasswordUser(UserPasswordRequest $request)
//    {
//        $request->UserPasswordRequest();
//        $User = Auth::user();
//        session(['msg' => 'value']);
//        return redirect()->route('editPasswordUser',['Id'=>$User]);
//
//    }
//
//    // ***************** Devuelve el Proximo Usuario++++++++++++++++++++ //
//    protected function getUsernameNext($Abreviatura = ''){
//        $data = [];
//        $msg = "OK";
//        //dd($Id);
//        $data = User::getUsernameNext($Abreviatura);
//
//        return Response::json(['mensaje' => $msg, 'data' => $data, 'status' => '200'], 200);
//
//    }
//
//
//
//
//    protected function addRoleItem($User){
//
//        $roles = Role::query()->where('id','>',3)->orderBy('name') ->pluck('name','id')->toArray();
//        $User = User::find($User);
//
//        return view('layouts.Accesorios._addRoleUser',[
//            "User"        => $User,
//            "Roles"       => $roles,
//            "TituloModal" => "Agregar rol a ".$User->nombre,
//            "RouteModal"   => 'createRoleUsuario',
//            'Method' => 'POST',
//            'msg' => $this->msg,
//            'IsNew' => true,
//        ]);
//
//    }
//
//    // ******************  AGREGAR ROLE A USUARIO *****************************
//    protected function createRoleItem(Request $request){
//        $data = json_decode( json_encode( $request->all() ) );
//        $User = User::find($data->user_id);
//        $User->roles()->detach( $data->role_id );
//        $User->roles()->attach( $data->role_id );
//        return redirect()->route('editUsuario',['Id'=>$User]);
//    }
//
//    protected function removeRoleItem($Id,$Dato1){
//        if ($Dato1 > 3){
//            $code = 'OK';
//            $msg = "Registro Eliminado con éxito!";
//            $User = User::find($Id);
//            $User->roles()->detach($Dato1);
//        }else{
//            $code = 'Error';
//            $msg = "No se puede eliminar el registro! ".$Dato1;
//        }
//        return Response::json(['mensaje' => $msg, 'data' => $code, 'status' => '200'], 200);
//    }
//
//



}
