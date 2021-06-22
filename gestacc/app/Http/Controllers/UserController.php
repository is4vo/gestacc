<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    /**
     * Lista los usuarios existentes en la base de datos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Muestra el formulario para editar el usuario dado.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('usuarios.editar', compact('usuario'));
    }

    /**
     * Actualiza los datos del usuario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if($user->email != $request->email){
            $validate=$request->validate([
                'email'=>'required|string|unique:user',
                ]);
            }

        $validate = $request->validate( [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $rol = $request->get('rol');
        $user->syncRoles([$rol]);
        $user->save();

        
        return  redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
