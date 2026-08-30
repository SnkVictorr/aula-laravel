<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Categoria;

class Produto extends Model
{
    // Define o nome da tabela que o Eloquent irá buscar caso não encontre a tabela com base no nome da classe
    // protected $table = 'produtos';


    // Define quais campos poderao ser preenchidos atraves do create
    protected $fillable = ["nome", "preco", "estoque", "categoria_id"];

    public function categoria(): BelongsTo
    {
        // O produto pertence a uma categoria. O laravel vai buscar a chave estrangeira categoria_id na tabela produtos e a chave primaria id na tabela categorias
        return $this->belongsTo(Categoria::class);
    }
}
