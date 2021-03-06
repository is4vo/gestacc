<?php

use App\Http\Controllers\AccionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActaController;
use App\Http\Controllers\AprobacionController;
use App\Http\Controllers\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

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
Route::get('/ver-choque', [ReunionController::class, 'choque_horarios'])->name('choque');
Route::get('/cambiar-estado-reunion', [ReunionController::class, 'cambiar_estado'])->middleware('can:actas')->name('reuniones.cambiar_estado');

//Actas
Route::resource('actas', ActaController::class)->except('destroy', 'index', 'create', 'update')->middleware('can:actas')->names('actas');

Route::get('/actas', [ActaController::class, 'index'])->name('actas.index');

Route::get('/actas/create/{id}', [ActaController::class, 'create'])->middleware('can:actas')->name('actas.create');

Route::post('/actas/update/{id}', [ActaController::class, 'update'])->middleware('can:actas')->name('actas.update');

Route::get('/actas-pendientes', [ActaController::class, 'pendientes'])->middleware('can:actas')->name('actas.pendientes');

Route::get('/actas/{id}/pdf', [ActaController::class, 'createPDF'])->name('actas.download');
Route::post('/actas/buscar', [ActaController::class, 'buscar'])->name('actas.buscar');

Route::get('/actas/{id}/aprobar', [AprobacionController::class, 'aprobar'])->middleware('can:actas')->name('actas.aprobar');

Route::get('/cambiar-estado-acta', [ActaController::class, 'cambiar_estado'])->middleware('can:actas')->name('actas.cambiar_estado');

