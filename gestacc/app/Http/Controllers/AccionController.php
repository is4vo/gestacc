<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use App\Models\Acta;
use App\Models\Tema;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rol = Auth::user()->roles->pluck('name')[0];
        if ($rol == 'Invitado'){
            $tareas = Accion::where('ref_usuario', Auth::id())
            ->where('tipo', 'Ejecución')
            ->where('estado', 'Pendiente')
            ->get();
        }
        else{
            $tareas = Accion::where('tipo', 'Ejecución')
            ->where('estado', 'Pendiente')
            ->get();
        }
        return view('tareas.index', compact('tareas'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accion  $accion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarea = Accion::find($id);
        $encargado = User::find($tarea->ref_usuario);
        $tema = Tema::find($tarea->ref_tema);
        $acta = Acta::find($tema->ref_acta);
        return view('tareas.show', compact('tarea', 'encargado', 'tema', 'acta'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accion  $accion
     * @return \Illuminate\Http\Response
     */
    public function done($id)
    {
        $tarea = Accion::find($id);
        $tarea->estado = 'Realizada';
        $tarea->save();
        return redirect()->route('tareas.index')->with('success', 'Tarea modificada con éxito.');
    }

    public function cancel($id)
    {
        $tarea = Accion::find($id);
        $tarea->estado = 'Cancelada';
        $tarea->save();
        return redirect()->route('tareas.index')->with('success', 'Tarea modificada con éxito.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accion  $accion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'comentarios_tarea' => ['required', 'max:255'],
        ]); 
        $tarea = Accion::find($id);
        $tarea->comentario = $data['comentarios_tarea'];
        $tarea->save();
        return redirect()->route('tareas.show', $id)->with('success', 'Comentario agregado con éxito.');
    }
}
