<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\AsistenteReunion;
use App\Models\Reunion;
use App\Models\TemaReunion;
use App\Models\User;
use Illuminate\Http\Request;

class ActaController extends Controller
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
        $id = 3;
        $reunion = Reunion::find($id);
        $asistentes_reunion = AsistenteReunion::where('ref_reunion', $id)->get();
        $asistentes = array();
        foreach ($asistentes_reunion as $a){
            $id_u = $a->ref_usuario;
            $u = User::find($id_u);
            array_push($asistentes, $u);
        }
        $temas = TemaReunion::where('ref_reunion', $id)->get();
        return view('actas.crear', compact('usuarios', 'reunion', 'asistentes', 'temas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function show(Acta $acta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function edit(Acta $acta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Acta $acta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Acta $acta)
    {
        //
    }
}
