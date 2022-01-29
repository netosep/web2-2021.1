<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';
    protected $fillable = [
        'id_cliente',
        'id_forma_pagamento',
        'id_caixa',
        'valor_total',
        'data_venda',
        'ativo'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagamento::class);
    }

}
