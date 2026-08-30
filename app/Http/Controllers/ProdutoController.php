<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdutosRequest;
// use Illuminate\Http\Request;
use App\Models\Produto;

use App\Http\Requests\UpdateProdutoRequest;
use App\Http\Resources\ProdutoResource;
use App\Models\Categoria;

class ProdutoController extends Controller
{
    public function index()
    {
        // // SELECT * FROM produtos;
        // $produtos = Produto::all();

        // SELECT * FROM produtos INNER JOIN categorias ON produtos.categoria_id = categorias.id
        $produtos = Produto::with('categoria')->get();

        // if (!$produtos) {
        //     return response()->json(["message" => "Produtos não encontrado"], 404);
        // }



        // return response()->json($produtos, 200);
        return ProdutoResource::collection($produtos);
    }

    // public function show(int $id)
    public function show(Produto $produto)
    {

        /* SELECT * FROM produtos WHERE id = :id
         $produto = Produto::find($id);

         if (!$produto) {
             return response()->json(["message" => "Produto não encontrado"], 404);
         }
         */

        // OU

        // $produto = Produto::findOrFail($id);

        // OU

        // SELECT * FROM produtos INNER JOIN categorias ON produtos.categoria_id = categorias.id WHERE produtos.id = :id
        // return response()->json($produto->load('categoria'), 200);


        /*{
    "data": {
        "id": 1,
        "nome": "Mouse Gamer",
        "preco": "150.00",
        "estoque": 10
    }
}
*/
        return new ProdutoResource($produto->load('categoria'));
    }

    // public function filterByCategoria(int $id)
    public function filterByCategoria(Categoria $categoria)
    {
        // $categoria = Categoria::findOrFail($id);

        $produtos = $categoria->produtos;
        return response()->json($produtos);
    }


    public function store(StoreProdutosRequest $request)
    {

        // // Se os dados forem invalidos o create não será criado
        // $dados = $request->validate([
        //     "nome" => 'required|string',
        //     "preco" => 'required|numeric|min:0',
        //     "estoque" => 'required|integer|min:0'
        // ]);

        // // INSERT INTO produtos(...) VALUES (...)
        // $produto = Produto::create(
        //     $dados
        //     // Adiciona os dados sem validaçào
        //     // $request->all()
        // );

        // $data["senha"] = Hash::make($data["senha"]);



        $produto = Produto::create(
            // Pegas os dados validados pelo StoreProdutosRequest
            $request->validated()
        );


        // sem o ProdutoResource:
        // return response()->json(
        //     $produto,
        //     201
        // );

        // com o ProdutoResource:
        // return (new ProdutoResource($produto))->response()->setStatusCode(201);

        // com o ProdutoResource e mensagem adicional:
        return (new ProdutoResource($produto))->additional(['message' => 'Produto criado com sucesso'])->response()->setStatusCode(201);
    }

    public function update(UpdateProdutoRequest $request, Produto $produto)
    {
        /* Route Model Binding ja faz isso
        // Pegando o Produto
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['message' => "Produto nào encontrado"], 404);
        }
        */


        // $data = $request->validate([
        //     // sometimes é útil para atualizações parciais
        //     "nome" => "sometimes|string|min:3|max:255",
        //     // "email"=> 'required|email',
        //     "senha" => "requiored|string|min:8|max:20",
        //     "preco" => "sometimes|numeric|min:0|max:999999.99",
        //     "estoque" => "sometimes|integer|min:0"
        // ]);


        // Atualizando o produto com os novos dados
        $produto->update(
            // $data
            $request->validated()
        );
        return response()->json($produto);
    }


    // public function destroy(int $id)
    public function destroy(Produto $produto)
    {
        // $produto = Produto::find($id);
        // if (!$produto) {
        //     return response()->json(['message' => "Produto nào encontrado"], 404);
        // }

        $produto->delete();

        return response()->json([
            'message' => 'Produto excluído'
        ]);
    }
}
