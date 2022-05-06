<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SIGSAS\Domicilio\CalleController;
use App\Http\Controllers\SIGSAS\Domicilio\CodigopostalController;
use App\Http\Controllers\SIGSAS\Domicilio\ColoniaController;
use App\Http\Controllers\SIGSAS\Domicilio\ComunidadController;
use App\Http\Controllers\SIGSAS\Domicilio\UbicacionController;
use App\Http\Controllers\SIGSAS\User\UserController;
use App\Http\Controllers\Storage\StorageProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('home',  [HomeController::class, 'index'])->name('home');

    Route::get('editProfile/{Id}',[UserController::class,'editProfile'])->name('editProfile');
    Route::put('updateProfile',[UserController::class,'updateProfile'])->name('updateProfile');
    Route::get('editPasswordUser/{Id}',[UserController::class,'editPasswordUser'])->name('editPasswordUser');
    Route::put('updatePasswordUser',[UserController::class,'updatePasswordUser'])->name('updatePasswordUser');
    Route::get('editFotodUser/{Id}',[UserController::class,'editFotodUser'])->name('editFotodUser');
//    Route::post('updateFotodUser',[ProfileStorageController::class,'subirArchivoProfile'])->name('updateFotodUser');

});

Route::group(['middleware' => 'role:auth|Administrator|SysOp|USER_OPERATOR_SIAC|USER_OPERATOR_ADMIN|ENLACE|USER_ARCHIVO_CAP|USER_ARCHIVO_ADMIN'], function () {

//    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('edit', [UserController::class,'showEditUserData'])->name('edit');
    Route::put('Edit', [UserController::class,'update'])->name('Edit');
    Route::get('showEditProfilePhoto/', [UserController::class,'showEditProfilePhoto'])->name('showEditProfilePhoto');
    Route::get('showEditProfilePassword/', [UserController::class,'showEditProfilePassword'])->name('showEditProfilePassword');
    Route::get('changePasswordUser/', [UserController::class,'changePasswordUser'])->name('changePasswordUser');
    Route::get('searchUser/', [UserController::class,'searchUser'])->name('searchUser');
    Route::get('getUser/{Id}', [UserController::class,'getUser'])->name('getUser');
    Route::get('subirFotoProfile/', [StorageProfileController::class,'subirArchivoProfile'])->name('subirArchivoProfile');
    Route::get('quitarFotoProfile/', [StorageProfileController::class,'quitarArchivoProfile'])->name('quitarArchivoProfile');

    // Catálogo de Usuarios
    Route::get('userList/',     [UserController::class,'index'])->name('userList');
    Route::get('newUser',     [UserController::class,'newItem'])->name('newUser');
    Route::post('createUser',     [UserController::class,'createItem'])->name('createUser');
    Route::get('editUser/{Id}', [UserController::class,'editItem'])->name('editUser');
    Route::put('updateUser',    [UserController::class,'updateItem'])->name('updateUser');
    Route::put('updateUserV2',     [UserController::class,'updateItemV2'])->name('updateUserV2');
    Route::get('removeUser/{id}',     [UserController::class,'removeItem'])->name('removeUser');

    // Catálogo de Colonias
    Route::get('listColonias/',          [ColoniaController::class,'index'])->name('listColonias');
    Route::get('editColonia/{Id}',       [ColoniaController::class,'editItem'])->name('editColonia');
    Route::put('updateColonia',          [ColoniaController::class,'updateItem'])->name('updateColonia');
    Route::get('newColonia',             [ColoniaController::class,'newItem'])->name('newColonia');
    Route::post('createColonia',         [ColoniaController::class,'createItem'])->name('createColonia');
    Route::get('buscarColonia/',         [ColoniaController::class,'buscarColonia'])->name('buscarColonia');
    Route::get('getColonia/{IdColonia}', [ColoniaController::class,'getColonia'])->name('getColonia');
    Route::get('removeColonia/{id}',     [ColoniaController::class,'removeItem'])->name('removeColonia');

    // Catálogo de Ubicaciones
    Route::get('listUbicaciones/',     [UbicacionController::class, 'index'])->name('listUbicaciones');
    Route::get('editUbicacion/{Id}',   [UbicacionController::class, 'editItem'])->name('editUbicacion');
    Route::put('updateUbicacion',      [UbicacionController::class, 'updateItem'])->name('updateUbicacion');
    Route::get('newUbicacion',         [UbicacionController::class, 'newItem'])->name('newUbicacion');
    Route::post('createUbicacion',     [UbicacionController::class, 'createItem'])->name('createUbicacion');
    Route::get('removeUbicacion/{id}', [UbicacionController::class, 'removeItem'])->name('removeUbicacion');

    Route::get('searchAdress/',        [UbicacionController::class, 'searchAdress'])->name('searchAdress');
    Route::get('getUbi/{IdUbi}',       [UbicacionController::class,'getUbi'])->name('getUbi');
    Route::get('newUbicacionV2',       [UbicacionController::class,'newItemV2'])->name('newUbicacionV2');
    Route::post('createUbicacionV2',   [UbicacionController::class,'createItemV2'])->name('createUbicacionV2');
    Route::get('editUbicacionV2/{Id}', [UbicacionController::class,'editItemV2'])->name('editUbicacionV2');
    Route::put('updateUbicacionV2',    [UbicacionController::class,'updateItemV2'])->name('updateUbicacionV2');


    // Catálogo de Calles
    Route::get('listCalles/',      [CalleController::class, 'index'])->name('listCalles');
    Route::get('editCalle/{Id}',   [CalleController::class, 'editItem'])->name('editCalle');
    Route::put('updateCalle',      [CalleController::class, 'updateItem'])->name('updateCalle');
    Route::get('newCalle',         [CalleController::class, 'newItem'])->name('newCalle');
    Route::post('createCalle',     [CalleController::class, 'createItem'])->name('createCalle');
    Route::get('removeCalle/{id}', [CalleController::class, 'removeItem'])->name('removeCalle');

    Route::get('newCalleV2',         [CalleController::class, 'newItemV2'])->name('newCalleV2');
    Route::post('createCalleV2',     [CalleController::class, 'createItemV2'])->name('createCalleV2');
    Route::get('editCalleV2/{Id}',   [CalleController::class, 'editItemV2'])->name('editCalleV2');
    Route::put('updateCalleV2',      [CalleController::class, 'updateItemV2'])->name('updateCalleV2');
    Route::get('buscarCalle/',       [CalleController::class, 'buscarCalle'])->name('buscarCalle');
    Route::get('getCalle/{IdCalle}', [CalleController::class, 'getCalle'])->name('getCalle');


    // Catálogo de Codigopostales
    Route::get('listCodigopostales', [CodigopostalController::class, 'index'])->name('listCodigopostales');
    Route::get('newCodigopostal', [CodigopostalController::class, 'newItem'])->name('newCodigopostal');
    Route::post('createCodigopostal', [CodigopostalController::class, 'createItem'])->name('createCodigopostal');
    Route::get('editCodigopostal/{Id}', [CodigopostalController::class, 'editItem'])->name('editCodigopostal');
    Route::put('updateCodigopostal', [CodigopostalController::class, 'updateItem'])->name('updateCodigopostal');
    Route::get('buscarCodigopostal/', [CodigopostalController::class, 'buscarCodigopostal'])->name('buscarCodigopostal');
    Route::get('getCodigopostal/{IdCodigopostal}', [CodigopostalController::class, 'getCodigopostal'])->name('getCodigopostal');
    Route::get('removeCodigopostal/{Id}', [CodigopostalController::class, 'removeItem'])->name('removeCodigopostal');

    Route::get('newCodigopostalV2', [CodigopostalController::class, 'newItemV2'])->name('newCodigopostalV2');
    Route::post('createCodigopostalV2', [CodigopostalController::class, 'createItemV2'])->name('createCodigopostalV2');
    Route::get('editCodigopostalV2/{Id}', [CodigopostalController::class, 'editItemV2'])->name('editCodigopostalV2');
    Route::put('updateCodigopostalV2', [CodigopostalController::class, 'updateItemV2'])->name('updateCodigopostalV2');

    // Catálogo de Comunidades
    Route::get('listComunidades/', [ComunidadController::class,'index'])->name('listComunidades');
    Route::get('newComunidad', [ComunidadController::class,'newItem'])->name('newComunidad');
    Route::post('createComunidad', [ComunidadController::class,'createItem'])->name('createComunidad');
    Route::get('editComunidad/{Id}', [ComunidadController::class,'editItem'])->name('editComunidad');
    Route::put('updateComunidad', [ComunidadController::class,'updateItem'])->name('updateComunidad');
    Route::get('buscarComunidad/', [ComunidadController::class,'buscarComunidad'])->name('buscarComunidad');
    Route::get('getComunidad/{IdComunidad}', [ComunidadController::class,'getComunidad'])->name('getComunidad');
    Route::get('removeComunidad/{id}', [ComunidadController::class,'removeItem'])->name('removeComunidad');

    Route::get('newComunidadV2', [ComunidadController::class,'newItemV2'])->name('newComunidadV2');
    Route::post('createComunidadV2', [ComunidadController::class,'createItemV2'])->name('createComunidadV2');
    Route::get('editComunidadV2/{Id}', [ComunidadController::class,'editItemV2'])->name('editComunidadV2');
    Route::put('updateComunidadV2', [ComunidadController::class,'updateItemV2'])->name('updateComunidadV2');



/* ********************************************************************************************************************** */








//    Route::get('quitarArchivoBase/{driver}/{archivo}', 'Storage\StorageExternalFilesController@quitarArchivoBase')->name('quitarArchivoBase/');
    Route::post('quitarArchivoBase', 'Storage\StorageExternalFilesController@quitarArchivoBase')->name('quitarArchivoBase');

    Route::post('showFileListUserExcel1A','External\User\ListUserXLSXController@getListUserXLSX')->name('showFileListUserExcel1A');

    Route::post('getUserByRoleToXLSX','External\User\ListUserXLSXController@getUserByRoleToXLSX')->name('getUserByRoleToXLSX');

    Route::post('getModelListXlS/{model}','External\ListModelXLSXController@getListModelXLSX')->name('getModelListXlS');


});






//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
