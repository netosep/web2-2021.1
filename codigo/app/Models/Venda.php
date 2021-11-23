<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $table = 'vendas';
    protected $fillable = [
        'cliente_id',  
        'valor_total'
    ];

    public function cliente() {
        return $this->belongsTo(Cliente::class);
    }

    public function itensVenda() {
        return $this->hasMany(ItemVenda::class);
    }

    public function produto() {
        return $this->hasManyThrough(ItemVenda::class, Produto::class);
    }
}
