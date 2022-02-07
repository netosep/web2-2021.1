<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';
    protected $fillable = [
        'nome_produto',
        'categoria_id',
        'descricao_produto',
        'preco_produto',
        'ativo'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function itensCompra()
    {
        return $this->hasMany(ItemCompra::class);
    }

    public function itensVenda()
    {
        return $this->hasMany(ItemVenda::class);
    }
    
}
