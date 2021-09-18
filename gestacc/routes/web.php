<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActaController;
use App\Http\Controllers\ReunionController;
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

Route::get('/actas-pendientes', function(){
    return view('actas.actasPendientes');
})->middleware('can:actasPendientes')->name('actas.actasPendientes');

Route::get('/buscar-actas', function(){
    return view('actas.buscarActas');
})->name('actas.buscarActas');

Route::get('/tareas', function(){
    return view('tareas.listaTareas');
})->middleware('can:tareas')->name('tareas');

Route::resource('usuarios', UserController::class)->except('show', 'destroy')->middleware('can:usuarios')->names('usuarios');
Route::get('/usuarios/{user}/enable', [UserController::class, 'enable' ])->middleware('can:usuarios')->name('usuarios.enable');
Route::resource('reuniones', ReunionController::class)->only('create', 'store')->middleware('can:reunion')->names('reuniones');
Route::resource('actas', ActaController::class)->only('create', 'store')->middleware('can:nuevaActa')->names('actas');

Auth::routes();