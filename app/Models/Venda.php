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
        'funcionario_id',
        'caixa_id',
        'valor_total',
        'desconto'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function pagamentoVenda()
    {
        return $this->hasMany(PagamentoVenda::class);
    }

}
