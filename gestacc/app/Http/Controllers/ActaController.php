<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use App\Models\Acta;
use App\Models\Asistente;
use App\Models\AsistenteReunion;
use App\Models\Reunion;
use App\Models\Tema;
use App\Models\TemaReunion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function create($id)
    {
        $usuarios = User::where('status', 1)->get();
        $reunion = Reunion::find($id);
        
        $asistentes_reunion = AsistenteReunion::where('ref_reunion', $id)->get();
        $asistentes = array();
        foreach ($asistentes_reunion as $a){
            $id_u = $a->ref_usuario;
            $u = User::find($id_u);
            array_push($asistentes, $u);
        };
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
        $data = $request->validate([
            'numero_reunion' => ['required', 'numeric'],
            'tipo_reunion' => ['required', 'max:255'],
            'fecha_reunion' => ['required', 'date'],
            'hora_inicio' => ['required', 'date_format:H:i:s'],
            'hora_termino' => ['required','date_format:H:i:s', 'after:hora_inicio'],
            'asistentes' => ['required'],
            'participantes' => ['required'],
        ]); 
        $reunion = Reunion::find($request->reunion);
        $reunion->estado = "Realizada";
        $reunion->save();

        $data['ref_usuario'] = Auth::id();
        $data['ref_reunion'] = $reunion->id;
        $acta = Acta::create($data);

        $temas = TemaReunion::where('ref_reunion', $reunion->id)->get();
        foreach ($temas as $tema){
            $tema_new = Tema::create(
                ['titulo' => $tema->titulo,
                'comentarios' => $request->comentariosTema[$tema->id],
                'ref_acta' => $acta->id]
            );
            $acciones = $request->input("accion" .$tema->id);
            $tipos = $request->input("tipo" .$tema->id);
            $vencimientos = $request->input("fechaVencimiento" .$tema->id);
            $encargados = $request->input("encargado" .$tema->id);
            if(!is_null($acciones)){
                for ($i=0; $i < count($acciones); $i++) { 
                    if($tipos[$i]=='Ejecución'){
                        Accion::create(
                            ['titulo' => $acciones[$i],
                            'tipo' => $tipos[$i],
                            'vencimiento' => $vencimientos[$i],
                            'estado' => 'Pendiente',
                            'ref_tema' => $tema_new->id,
                            'ref_usuario' => $encargados[$i]
                            ]);
                    }
                    else{
                        Accion::create(
                            ['titulo' => $acciones[$i],
                            'tipo' => $tipos[$i],
                            'ref_tema' => $tema_new->id,
                            ]);
                    }
                }
            }
            
        };
        $asistentes = $request->input('asistentes');
        $participantes = $request->input('participantes');
        foreach($asistentes as $asistente){
            if (in_array($asistente, $participantes)){
                Asistente::create(
                    ['ref_usuario' => $asistente,
                    'ref_acta' => $acta->id,
                    'asiste' => 1]
                );
            }
            else{
                Asistente::create(
                    ['ref_usuario' => $asistente,
                    'ref_acta' => $acta->id,
                    'asiste' => 0]
                );
            }
        };
        
        
        return redirect()->route('home')->with('success', 'Acta guardada con éxito.');
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
