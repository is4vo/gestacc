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
use App\Notifications\NuevaTarea;
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
        $actas = Acta::where('estado', 'Pendiente')->get();
        return view('actas.pendientes', compact('actas'));
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
            'hora_inicio' => ['required'],
            'hora_termino' => ['required', 'after:hora_inicio'],
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
        $actas = Acta::all();
        return view('actas.index', compact('actas'));
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
            $actas = Acta::where('estado', 'Cerrada')->pluck('id')->toArray();
        }
        else{
            $actas = Acta::all()->pluck('id')->toArray();
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
        if($request->input('Consejo de Escuela') == 'on'){
            $actas_tipos_con = Acta::where('tipo_reunion', 'Consejo de Escuela')->pluck('id')->toArray();
            $actas_tipos = array_merge($actas_tipos, $actas_tipos_con);
        }
        if(!empty($actas_tipos)){
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
            if(!empty($actas_keywords)){
                $actas = array_intersect($actas, $actas_keywords);
            }
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
        //return view('actas.download', compact('acta', 'asistentes', 'temas', 'ver'));
    }


}
