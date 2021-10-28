<?php

namespace App\Http\Controllers;


use App\Models\Accion;
use App\Models\Reunion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $reuniones = Reunion::where('ref_usuario', Auth::id())
            ->where('estado', 'Pendiente')
            ->orderBy('fecha_reunion', 'asc')
            ->take(5)->get();
            $tareas = Accion::where('ref_usuario', Auth::id())
            ->where('tipo', 'Ejecución')
            ->where('estado', 'Pendiente')
            ->orderBy('vencimiento', 'asc')
            ->take(5)
            ->get();
            $alertas = [];
            if (Auth::user()->hasPermissionTo('reunion')){
                $reuniones_no_realizadas = Reunion::where('fecha_reunion', '<', Carbon::now())
                ->where('estado', 'Pendiente')
                ->get();
                foreach($reuniones_no_realizadas as $rnr){
                    array_push($alertas, "Reunión ". $rnr->tipo_reunion. " ". $rnr->numero_reunion. " no realizada. Cancelar o crear acta de reunión.");
                }
            }
            
            return view('home', compact('reuniones', 'tareas', 'alertas'));
        }
        else{
            return view('guest');
        }

        
    }
}
