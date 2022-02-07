<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPagamento extends Model
{
    use HasFactory;

    protected $table = 'formas_pagamento';
    protected $fillable = [
        'forma_pagamento'
    ];

    public function pagamentoCompra()
    {
        return $this->hasMany(PagamentoCompra::class);
    }

    public function pagamentoVenda()
    {
        return $this->hasMany(PagamentoVenda::class);
    }

}
