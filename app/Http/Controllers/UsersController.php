<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//IMPORTAR MODELO
use App\Models\User;    
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    public function getUsers() {
        /* select * from users */
        $data = User::all();
        //dd($data);
        return view('admin/users')
        ->with('usuarios', $data);
    }
    public function createUsers(Request $request) {
        //dd($request->email);
        //REGLAS DE VALIDACIÓN
        $request->validate([
            'name' => 'required|min:3',
            'nickname' => 'required|min:3|unique:users,nickname',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'password2' => 'required|same:password'
        ]);

        //INSERTAR REGISTRO
        $user = new User();
        $user->name = $request->name;
        $user->nickname = $request->nickname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->img = 'default.png';
        $user->save();
        return redirect()
            ->back()
            ->with('success', 'Usuario creado correctamente');  
        //return redirect('/dashboard/users');
    }

}
