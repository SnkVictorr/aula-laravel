<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// ::class retorna o nome completo da classe
Route::get('/produtos', [ProdutoController::class, 'index']);


// Route::get("/produtos/{id}", [ProdutoController::class, 'show']);
Route::get("/produtos/{produto}", [ProdutoController::class, 'show']);

Route::get("/produtos/categoria/{categoria}", [ProdutoController::class, 'filterByCategoria']);

// Usando Middleware em mais de uma rota
Route::middleware('admin')->group(function () {
    Route::post("/produtos", [ProdutoController::class, "store"]);

    // {id}
    Route::put("/produtos/{produto}", [ProdutoController::class, "update"]);
});
// Route::delete(
//     '/produtos/{id}',
//     [ProdutoController::class, 'destroy']
// );
Route::delete("/produtos/{produto}", [ProdutoController::class, 'destroy'])->middleware('admin');


// A função só será executado caso passe pela verificação do middleware
Route::get('/admin', function () {
    return response()->json(['message' => "Área Administrativa"]);
})->middleware('admin');


// Precisa estar autenticado
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/needAuth', function () {
        return response()->json(['message' => 'Usuario Autenticado']);
    });
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get(
        '/me',
        function (Request $request) {
            return $request->user();
        }
    );

    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/categorias', [CategoriaController::class, 'createCategoria']);


Route::get('/categorias', function (Request $request) {
    return $request->categorias();
});


Route::get('/categorias/{categoria}', [CategoriaController::class, 'show']);
