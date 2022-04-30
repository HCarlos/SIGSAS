<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SIGSAS\Domicilio\UbicacionController;
use App\Http\Controllers\SIGSAS\User\UserController;
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

    Route::get('edit', 'Catalogos\User\UserDataController@showEditUserData')->name('edit');
    Route::put('Edit', 'Catalogos\User\UserDataController@update')->name('Edit');
    Route::get('showEditProfilePhoto/', 'Catalogos\User\UserDataController@showEditProfilePhoto')->name('showEditProfilePhoto/');



    // Nuevo Módulo de Usuarios
//    Route::get('editUser/{Id}', 'Catalogos\User\UserDataController@editItem')->name('editUser');

    Route::get('userList/',[UserController::class,'index'])->name('userList');
    Route::get('editUser/{Id}', [UserController::class,'editItem'])->name('editUser');
    Route::put('updateUser', [UserController::class,'updateItem'])->name('updateUser');
    Route::get('searchAdress/', [UbicacionController::class, 'searchAdress'])->name('searchAdress');
    Route::get('getUbi/{IdUbi}', [UbicacionController::class,'getUbi'])->name('getUbi');






    Route::put('updateUserV2', 'Catalogos\User\UserDataController@updateUserV2')->name('updateUserV2');

    Route::get('newUser', 'Catalogos\User\UserDataController@newUser')->name('newUser');
    Route::post('createUser', 'Catalogos\User\UserDataController@createUser')->name('createUser');
    Route::get('removeUser/{id}', 'Catalogos\User\UserDataController@removeUser')->name('removeUser');






//    Route::get('quitarArchivoBase/{driver}/{archivo}', 'Storage\StorageExternalFilesController@quitarArchivoBase')->name('quitarArchivoBase/');
    Route::post('quitarArchivoBase', 'Storage\StorageExternalFilesController@quitarArchivoBase')->name('quitarArchivoBase');

    Route::post('showFileListUserExcel1A','External\User\ListUserXLSXController@getListUserXLSX')->name('showFileListUserExcel1A');

    Route::post('getUserByRoleToXLSX','External\User\ListUserXLSXController@getUserByRoleToXLSX')->name('getUserByRoleToXLSX');

    Route::post('getModelListXlS/{model}','External\ListModelXLSXController@getListModelXLSX')->name('getModelListXlS');


});






//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
