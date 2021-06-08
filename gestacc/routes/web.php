<?php

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
    return view('home');
})->name('home');

Route::get('/nuevaacta', function(){
    return view('nuevaActa');
})->name('nuevaActa');

Route::get('/actaspendientes', function(){
    return view('actasPendientes');
})->name('actasPendientes');

Route::get('/buscaractas', function(){
    return view('buscarActas');
})->name('buscarActas');

Route::get('/tareas', function(){
    return view('listaTareas');
})->name('tareas');

Route::get('/reunion', function(){
    return view('nuevaReunion');
})->name('reunion');

Route::get('/usuarios', function(){
    return view('usuarios');
})->name('usuarios');

Route::get('/login', function(){
    return view('login');
})->name('iniciarSesion');

