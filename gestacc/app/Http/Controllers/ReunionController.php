<?php

namespace App\Http\Controllers;

use App\Models\AsistenteReunion;
use App\Models\Reunion;
use App\Models\TemaReunion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::all();
        return view('reuniones.crear', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'numero_reunion' => ['required', 'numeric', 'unique:reunions'],
            'tipo_reunion' => ['required', 'max:255'],
            'fecha_reunion' => ['required', 'date', 'after_or_equal:today'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_termino' => ['required','date_format:H:i', 'after:hora_inicio'],
            'asistentes' => ['required'],
        ]);
        $data['ref_usuario'] = Auth::id();
        $asistentes = $request->input('asistentes');
        $temas = $request->lista_temas;
        $reunion = Reunion::create($data);
        
        
        foreach ($asistentes as $asistente){
            AsistenteReunion::create(
                ['ref_reunion' => $reunion->id,
                'ref_usuario' => $asistente]
            );
        }
        
        foreach ($temas as $tema){
            TemaReunion::create(
                ['titulo' => $tema,
                'ref_reunion' => $reunion->id]
            );
        }

        return redirect('/')->with('success', 'Reunión creada con éxito.');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reunion  $reunion
     * @return \Illuminate\Http\Response
     */
    public function show(Reunion $reunion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reunion  $reunion
     * @return \Illuminate\Http\Response
     */
    public function edit(Reunion $reunion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reunion  $reunion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reunion $reunion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reunion  $reunion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reunion $reunion)
    {
        //
    }
}
