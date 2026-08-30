<?php

namespace App\Http\Controllers;

use App\Http\Requests\registerRequest;
use Illuminate\Http\Request;
use App\Models\User;

// Necessário para usar hashear a senha
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(registerRequest $request)
    {
        $dados = $request->validated();

        $user = User::create([
            "name" => $dados['name'],
            "email" => $dados['email'],
            // Hasheando a senha
            "password" => Hash::make($dados['password'])
        ]);

        // return response()->json([
        //     "message" => 'Usuário criado com sucesso'
        // ], 201);
    }

    public function login(Request $request)
    {
        $dados = $request->validate([
            "email" => 'required|email|max:255',
            'password' => 'required|string|min:6|max:20'
        ]);

        // Seleciona o usuario pelo email
        $user = User::where('email', $dados['email'])->first();


        // Verificando a senha
        if (!$user || !Hash::check($dados['password'], $user->password)) {
            return response()->json(["message" => "Usuário ou senha inválido"], 401);
        }

        $token = $user->createToken(
            'api-token'
        )->plainTextToken; // plainTextToken pega o token do objeto accessToken
        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json(['message' => "Login Realizado com sucesso", 'user' => $user, 'token' => $token]);
    }

    public function logout(Request $request)
    {
        // Pega o usuario que fez o request, pega o token atual e inválida
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado']);
    }

    public function lloooogin(Request $request)
    {
        $dados = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:20'
        ]);

        $user = User::where('email', $request['email'])->first();

        if (!$user || Hash::check($dados['password'], $user->email)) {
            return response()->json(["Login Inválido"], 401);
        }
    }
}
