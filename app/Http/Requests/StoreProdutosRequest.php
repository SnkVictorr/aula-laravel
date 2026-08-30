<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProdutosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => "required|string|min:3|max:255",
            "preco" => "required|numeric|min:0|max:999999.99",
            "estoque" => "required|integer",
            // exists:categorias,id -> verifica se o id da categoria existe na tabela categorias
            'categoria_id' => 'required|intenger|exists:categorias,id'
        ];
    }
}
