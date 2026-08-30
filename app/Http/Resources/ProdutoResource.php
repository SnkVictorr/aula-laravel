<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\CategoriaResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Quando transformar o produto em json, envie só estes campos
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'preco' => $this->preco,
            'estoque' => $this->estoque,

            // 'categoria' => [
            //     "id" => $this->categoria->id,
            //     'nome' => $this->categoria->nome,
            // ]

            // A categoria só será enviada se ela estiver carregada, caso contrário, não será enviada
            // 'categoria' => new CategoriaResource($this->whenLoaded('categoria'))
            'categoria' => CategoriaResource::make($this->whenLoaded('categoria'))
        ];
    }
}
