<?php

namespace App\Http\Controllers;

use App\Models\AsistenteReunion;
use App\Models\Reunion;
use App\Models\TemaReunion;
use App\Models\User;
use App\Notifications\NuevaReunion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReunionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reuniones = Reunion::orderBy('fecha_reunion', 'DESC')->get();

        return view('reuniones.index', compact('reuniones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarios = User::where('status', 1)->get();
        $regular = DB::table('reunions')->select('numero_reunion')->where('tipo_reunion', 'Regular')->orderBy('id','DESC')->first();
        $extraordinaria = DB::table('reunions')->select('numero_reunion')->where('tipo_reunion', 'Extraordinaria')->orderBy('id','DESC')->first();
        $consejo = DB::table('reunions')->select('numero_reunion')->where('tipo_reunion', 'Consejo de Escuela')->orderBy('id','DESC')->first();

        $numero_reuniones = array(
            'regular' => (is_null($regular) ? 0 : $regular->numero_reunion),
            'extraordinaria' => (is_null($extraordinaria) ? 0 : $extraordinaria->numero_reunion),
            'consejo' => (is_null($consejo) ? 0 : $consejo->numero_reunion),
        );
        $numero_reuniones['regular']++;
        $numero_reuniones['extraordinaria']++;
        $numero_reuniones['consejo']++;

        return view('reuniones.crear', compact('usuarios', 'numero_reuniones'));
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
            'fecha_reunion' => ['required', 'date', 'after_or_equal:today'],
            'hora_inicio' => ['required', 'date_format:H:i'],
            'hora_termino' => ['required','date_format:H:i', 'after:hora_inicio'],
            'asistentes' => ['required'],
            'lista_temas' => ['required'],
            'lista_temas.*' => ['required', 'string', 'distinct'],
        ]);

        $data['ref_usuario'] = Auth::id();
        $asistentes = $request->input('asistentes');
        $temas = $request->input('lista_temas');
        $reunion = Reunion::create($data);
        foreach ($asistentes as $asistente){
            AsistenteReunion::create(
                ['ref_reunion' => $reunion->id,
                'ref_usuario' => $asistente]
            );
            $user = User::find($asistente);
            $user->notify(new NuevaReunion($reunion));
        };
        foreach ($temas as $tema){
            if($tema!='Varios'){
                TemaReunion::create(
                    ['titulo' => $tema,
                    'ref_reunion' => $reunion->id]
                );
            }
        };
        TemaReunion::create(
            ['titulo' => 'Varios',
            'ref_reunion' => $reunion->id]
        );
        
        return redirect()->route('reuniones.index')->with('success', 'Reunión creada con éxito.');
    }

    /**
     * Cancela la reunion.
     *
     * @param  \App\Models\Reunion  $reunion
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $reunion = Reunion::find($id);
        $reunion->estado = "Cancelada";
        $reunion->save();
        return redirect()->route('reuniones.index')->with('warning', 'Reunión cancelada.');
    }

    public function choque_horarios(Request $request){
        echo 'controller';
        $fecha = $request->input('fecha_reunion');
        $inicio = $request->input('hora_inicio');
        $termino = $request->input('hora_termino');
        $reunion = Reunion::where('fecha_reunion', $fecha)->where(function($query) use ($inicio, $termino) {
            $query->where(function ($query) use ($inicio, $termino) {
                $query->where('hora_inicio', '>=', $inicio)->where('hora_termino', '<=', $inicio);
            })->orWhere(function($query) use ($inicio, $termino) {
                $query->where('hora_inicio', '>=', $termino)->where('hora_termino', '<=', $termino);
            });
        })->get();
        if(!empty($reunion)){
            echo 'Existe un choque de horario';
        }
    }

    public function cambiar_estado(Request $request){
        $reunion = Reunion::find($request->input('id'));
        $reunion->abierta = 0;
        $reunion->save();
    }
}
