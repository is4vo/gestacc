<?php

namespace App\Http\Controllers;

use App\Models\Acta;
use App\Models\Aprobacion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AprobacionController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aprobar($id)
    {
        $aprobacion = Aprobacion::where('ref_acta', $id)->where('ref_miembro', Auth::id())->first();
        $aprobacion->aprueba = 1;
        $aprobacion->save();

        //Verificar si todos han aprobado
        $miembros = count(User::role(['Miembro', 'Admin'])->get()->toArray());
        $aprobada = 0;
        $aprobaciones = Aprobacion::where('ref_acta', $id)->get();
        
        foreach($aprobaciones as $a){
            if($a->aprueba == 1){
                $aprobada++;
            }
        }
        if($aprobada == $miembros){
            $acta = Acta::find($id);
            $acta->estado = 'Cerrada';
            $acta->save();
        }
        return redirect()->route('actas.pendientes')->with('success', 'Acta aprobada.');

    }

}
