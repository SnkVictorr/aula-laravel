<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;


class CategoriaController extends Controller
{
    public function createCategoria(Request $request)
    {
        $categoria = $request->validate(['nome' => 'required|string|unique:categorias|max:255']);

        Categoria::create(['nome' => $categoria['nome']]);

        return response()->json($categoria, 201);
    }
    public function show(Categoria $categoria)
    {
        $categoria->load('produtos');
        return response()->json($categoria);
    }
}
