<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCompra extends Model
{
    use HasFactory;

    protected $table = 'itens_compra';
    protected $fillable = [
        'compra_id',
        'produto_id',
        'ipi',
        'icms',
        'frete',
        'valor_compra',
        'quantidade'
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
