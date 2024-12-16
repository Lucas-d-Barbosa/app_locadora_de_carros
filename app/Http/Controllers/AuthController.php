<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $credenciais = $request->all(['email', 'password']);
        // autenticação do usuário (email e senha)

        $token = auth('api')->attempt($credenciais);

        if($token) // Usuário autenticado com sucesso!
        {
            // retornar um jwt (Jason Web Token)
            return response()->json(['token'=> $token], 200);
        }

        return response()->json(['erro' => 'Usuário ou senha inválido!'], 403);
     
    }


    public function logout()
    {
        return 'logout';
    }


    public function refresh()
    {
        $token = auth('api')->refresh(); // cliente encaminhe um jwt válido
        return response()->json(['token' => $token]);
    }


    public function me(Request $request)
    {
        return response()->json((auth()->user()));
        return "me";
    }
}
