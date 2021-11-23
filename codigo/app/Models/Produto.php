<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $table = 'produtos';
    protected $fillable = [
        'nome', 
        'valor_compra', 
        'valor_venda', 
        'porcentagem_lucro',
        'quantidade'
    ];

    public function itensVenda() {
        return $this->hasMany(ItemVenda::class);
    }

    public function itensCompra() {
        return $this->hasMany(ItemCompra::class);
    }
}
