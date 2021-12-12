<?php

namespace App\Http\Controllers;

use App\Models\Accion;
use App\Models\Acta;
use App\Models\Aprobacion;
use App\Models\Asistente;
use App\Models\AsistenteReunion;
use App\Models\Reunion;
use App\Models\Tema;
use App\Models\TemaReunion;
use App\Models\User;
use App\Notifications\NuevaTarea;
use App\Notifications\ActaPendiente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class ActaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendientes()
    {
        $pendientes = Aprobacion::where('ref_miembro', Auth::id())->where('aprueba', 0)->pluck('ref_acta')->toArray();
        $actas = Acta::find($pendientes);
        return view('actas.pendientes', compact('actas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $reunion = Reunion::find($id);
        if($reunion->abierta == 0){
            $reunion->abierta = 1;
            $reunion->save();
            $usuarios = User::where('status', 1)->get();

            $asistentes_reunion = AsistenteReunion::where('ref_reunion', $id)->get();
            $asistentes = array();
            foreach ($asistentes_reunion as $a){
                $id_u = $a->ref_usuario;
                $u = User::find($id_u);
                array_push($asistentes, $u);
            };
            $temas = TemaReunion::where('ref_reunion', $id)->get();

            $pendientes = Acta::where('estado', 'Pendiente')->where('fecha_reunion', '<', $reunion->fecha_reunion)->get();
            foreach($pendientes as $pendiente){
                $faltan = Aprobacion::where('ref_acta', $pendiente->id)->where('aprueba', 0)->pluck('ref_miembro')->toArray();
                $pendiente['miembros_faltantes'] = User::find($faltan);
            }
            return view('actas.crear', compact('usuarios', 'reunion', 'asistentes', 'temas', 'pendientes'));
        }
        else{
            return redirect()->route('reuniones.index')->with('error', 'El acta ya está siendo creada.');
        }
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
            'hora_inicio' => ['required'],
            'hora_termino' => ['required', 'after:hora_inicio'],
            'asistentes' => ['required'],
            'participantes' => ['required'],
        ]); 

        //Cambia estado de reunion
        $reunion = Reunion::find($request->reunion);
        $reunion->estado = "Realizada";
        $reunion->abierta = 0;
        $reunion->save();

        //Crea el acta
        $data['ref_usuario'] = Auth::id();
        $data['ref_reunion'] = $reunion->id;
        $acta = Acta::create($data);

        //Crea los temas, tareas y acuerdos
        $temas = TemaReunion::where('ref_reunion', $reunion->id)->get();
        foreach ($temas as $tema){
            $acciones = $request->input("accion" .$tema->id);
            if(!is_null( $request->comentariosTema[$tema->id]) || !is_null($acciones)){
                $tema_new = Tema::create(
                    ['titulo' => $tema->titulo,
                    'comentarios' => $request->comentariosTema[$tema->id],
                    'ref_acta' => $acta->id]
                );
                
                $tipos = $request->input("tipo" .$tema->id);
                $vencimientos = $request->input("fechaVencimiento" .$tema->id);
                $encargados = $request->input("encargado" .$tema->id);
                
                if(!is_null($acciones)){
                    for ($i=0; $i < count($acciones); $i++) { 
                        if($tipos[$i]=='Ejecución'){
                            $tarea = Accion::create(
                                ['titulo' => $acciones[$i],
                                'tipo' => $tipos[$i],
                                'vencimiento' => $vencimientos[$i],
                                'estado' => 'Pendiente',
                                'ref_tema' => $tema_new->id,
                                'ref_acta' => $acta->id,
                                'ref_usuario' => $encargados[$i]
                                ]);
                                $user = User::find($encargados[$i]);
                                $user->notify(new NuevaTarea($tarea));
                        }
                        else{
                            Accion::create(
                                ['titulo' => $acciones[$i],
                                'tipo' => $tipos[$i],
                                'ref_tema' => $tema_new->id,
                                'ref_acta' => $acta->id,
                                ]);
                        }
                    }
                }
            }
            
        };

        //Registra los asistentes
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

        //Crea la aprobacion del acta
        $miembros = User::role(['Miembro', 'Admin'])->where('status', 1)->get();
        foreach($miembros as $miembro){
            Aprobacion::create(
                ['ref_miembro' => $miembro->id,
                'ref_acta' => $acta->id]
            );
            $miembro->notify(new ActaPendiente($acta));
        }
        
        return redirect()->route('home')->with('success', 'Acta guardada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acta = Acta::find($id);
        $temas = Tema::where('ref_acta', $id)->get();
        foreach($temas as $tema){
            $tema['tareas'] = Accion::where('ref_tema', $tema->id)->get();
        }
        return view('actas.show', compact('acta', 'temas'));
    }

    public function index()
    {
        $actas = Acta::orderBy('fecha_reunion', 'DESC')->get();
        return view('actas.index', compact('actas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acta = Acta::find($id);
        if($acta->abierta == 0){
            $acta->abierta = 1;
            $acta->save();
            $temas = Tema::where('ref_acta', $id)->get();

            foreach($temas as $tema){
                $tema['tareas'] = Accion::where('ref_tema', $tema->id)->get();
            }
                
            return view('actas.adenda', compact('acta', 'temas'));
            
        }
        else{
            return redirect()->back()->with('error', 'El acta ya está siendo editada.');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'adendas' => ['required'],
        ]); 
        $acta = Acta::find($id);
        $acta->abierta = 0;
        $acta->adendas = $request->adendas;
        $acta->save();

        //Crea la aprobacion del acta
        $aprobacion = Aprobacion::where('ref_acta', $acta->id)->get();
        foreach($aprobacion as $a){
            $a->aprueba = 0;
            $a->save();
            $miembro = User::find($a->ref_miembro);
            $miembro->notify(new ActaPendiente($acta));
        }
        return redirect()->route('actas.show', $acta->id)->with('success', 'Acta modificada con éxito.');

    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Acta  $acta
     * @return \Illuminate\Http\Response
     */
    public function buscar(Request $request)
    {
        $request->validate([
            'fecha_inicial' => ['nullable', 'date', 'required_with:fecha_final' ],
            'fecha_final' => ['nullable', 'date', 'after:fecha_inicial', 'required_with:fecha_inicial']
        ]);
        $actas = [];
        if($request->input('cerradas')=='on'){
            $actas = Acta::where('estado', 'Cerrada')->orderBy('fecha_reunion', 'desc')->pluck('id')->toArray();
        }
        else{
            $actas = Acta::orderBy('fecha_reunion', 'desc')->pluck('id')->toArray();
        }
        if($request->fecha_inicial!=null && $request->fecha_final!=null){
            $actas_aux = Acta::where('fecha_reunion', '>=', $request->fecha_inicial)->where('fecha_reunion', '<=', $request->fecha_final)->pluck('id')->toArray();
            $actas = array_intersect($actas, $actas_aux);
        }
        
        if($request->input('participado') == 'on'){
            $actas_aux = Asistente::where('ref_usuario', Auth::id())->where('asiste', 1)->pluck('ref_acta')->toArray();
            $actas = array_intersect($actas, $actas_aux);
        }
        $actas_tipos = [];
        if($request->input('Regular') == 'on'){
            $actas_tipos_reg = Acta::where('tipo_reunion', 'Regular')->pluck('id')->toArray();
            $actas_tipos = array_merge($actas_tipos, $actas_tipos_reg);
        }
        if($request->input('Extraordinaria') == 'on'){
            $actas_tipos_ex = Acta::where('tipo_reunion', 'Extraordinaria')->pluck('id')->toArray();
            $actas_tipos = array_merge($actas_tipos, $actas_tipos_ex);
        }
        if($request->input('Consejo') == 'on'){
            $actas_tipos_con = Acta::where('tipo_reunion', 'Consejo de Escuela')->pluck('id')->toArray();
            $actas_tipos = array_merge($actas_tipos, $actas_tipos_con);
        }
        if($request->input('Regular') == 'on' || $request->input('Extraordinaria') == 'on' || $request->input('Consejo') == 'on'){
            $actas = array_intersect($actas, $actas_tipos);
        }
        if($request->keywords!=null){
            $actas_keywords = [];
            if($request->input('temas') == 'on'){
                $actas_temas = Tema::where('titulo', 'like', '%'.$request->keywords.'%')->pluck('ref_acta')->toArray();
                $actas_keywords = array_unique(array_merge($actas_keywords, $actas_temas));
            }
            if($request->input('comentarios') == 'on'){
                $actas_comentarios = Tema::where('comentarios', 'like', '%'.$request->keywords.'%')->pluck('ref_acta')->toArray();
                $actas_keywords = array_unique(array_merge($actas_keywords, $actas_comentarios));
            }
            if($request->input('acuerdos') == 'on'){
                $actas_acuerdos = Accion::where('titulo', 'like', '%'.$request->keywords.'%')->where('tipo', 'Acuerdo')->pluck('ref_acta')->toArray();
                $actas_keywords = array_unique(array_merge($actas_keywords, $actas_acuerdos));
            }
            if($request->input('tareas') == 'on'){
                $actas_tareas = Accion::where('titulo', 'like', '%'.$request->keywords.'%')->where('tipo', 'Ejecucion')->pluck('ref_acta')->toArray();
                $actas_keywords = array_unique(array_merge($actas_keywords, $actas_tareas));
            }
            $actas = array_intersect($actas, $actas_keywords);
        }
        $resultados = Acta::find($actas);
        return view('actas.resultados', compact('resultados'));
    }

    // Genera PDF
    public function createPDF($id) {
        $acta = Acta::find($id);
        $temas = Tema::where('ref_acta', $id)->get();
        $ver = 0;
        $asistentes = [];
        if(Auth::check()){
            $asistentes_aux = Asistente::where('ref_acta', $id)->where('asiste', 1)->pluck('ref_usuario');
            foreach ($asistentes_aux as $a){
                $user = User::find($a);
                array_push($asistentes, $user);
            }
            if (in_array(Auth::user(), $asistentes) || Auth::user()->hasPermissionTo('actas')){
                $ver = 1;
                foreach ($temas as $tema){
                    $tema['acciones'] = Accion::where('ref_tema', $tema->id)->get();
                    foreach($tema['acciones'] as $accion){
                        $accion['usuario'] = User::find($accion->ref_usuario);
                    }
                }
            }
        }
        $data = [
            'acta' => $acta,
            'asistentes' => $asistentes,
            'temas' => $temas,
            'ver' => $ver
        ];
        $pdf = PDF::loadView('actas.download', $data)->setPaper('letter');
        return $pdf->stream('acta.pdf');
    }

    public function cambiar_estado(Request $request){
        $acta = Acta::find($request->input('id'));
        $acta->abierta = 0;
        $acta->save();
    }


}
