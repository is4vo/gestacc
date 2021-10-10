<?php

use App\Http\Controllers\AccionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActaController;
use App\Http\Controllers\ReunionController;
use App\Models\Accion;
use Illuminate\Support\Facades\Auth;

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
    return view('home');
})->name('home');

//Tareas
Route::resource('tareas', AccionController::class)->only('index', 'show')->middleware('can:tareas')->names('tareas');
Route::post('tareas/{id}/update', [AccionController::class, 'update'])->middleware('can:tareas')->name('tareas.update');
Route::get('/tareas/{id}/done', [AccionController::class, 'done'])->middleware('can:reunion')->name('tareas.done');
Route::get('/tareas/{id}/cancel', [AccionController::class, 'cancel'])->middleware('can:reunion')->name('tareas.cancel');

// Usuarios
Route::resource('usuarios', UserController::class)->except('show', 'destroy')->middleware('can:usuarios')->names('usuarios');
Route::get('/usuarios/{user}/enable', [UserController::class, 'enable' ])->middleware('can:usuarios')->name('usuarios.enable');
Auth::routes();

//Reuniones
Route::resource('reuniones', ReunionController::class)->only('create', 'index', 'store')->middleware('can:reunion')->names('reuniones');
Route::get('/reuniones/{user}/cancel', [ReunionController::class, 'cancel' ])->middleware('can:reunion')->name('reuniones.cancel');

//Actas
Route::resource('actas', ActaController::class)->only('store')->middleware('can:nuevaActa')->names('actas');

Route::get('/actas/create/{id}', [ActaController::class, 'create' ])->middleware('can:nuevaActa')->name('actas.create');

Route::get('/actas/pendientes', function(){
    return view('actas.actasPendientes');
})->middleware('can:actasPendientes')->name('actas.actasPendientes');
Route::get('/actas/index', function(){
    return view('actas.buscarActas');
})->name('actas.buscarActas');
