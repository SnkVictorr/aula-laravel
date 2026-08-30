<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Categoria extends Model
{
    protected $fillable = ["nome"];

    public function produtos(): HasMany
    {
        // Uma categoria tem vários produtos. O laravel vai buscar a chave estrangeira categoria_id na tabela produtos e a chave primaria id na tabela categorias
        return $this->hasMany(Produto::class);
    }
}
