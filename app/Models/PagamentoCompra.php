<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagamentoCompra extends Model
{
    use HasFactory;

    protected $table = 'pagamento_compra';
    protected $fillable = [
        'compra_id',
        'forma_pagamento_id',
        'parcelas'
    ];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }

    public function formaPagamento()
    {
        return $this->belongsTo(FormaPagamento::class);
    }

    public function parcelas()
    {
        return $this->hasMany(ParcelaCompra::class);
    }

}
