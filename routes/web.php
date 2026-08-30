<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/teste', function () {
    return "Olá Laravel";
});

Route::get('/produtos/{id}', function ($id) {
    return $id;
});


// ::class retorna o nome completo da classe
Route::get('/produtos', [ProdutoController::class, 'index']);

Route::get("/produtos/{id}", [ProdutoController::class, 'show']);

Route::post("/produtos", [ProdutoController::class, "store"]);

Route::put("/produtos{id}", [ProdutoController::class, "update"]);

Route::delete(
    '/produtos/{id}',
    [ProdutoController::class, 'destroy']
);
