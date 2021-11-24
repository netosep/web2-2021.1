<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'clientes';
    protected $fillable = [
        'nome', 
        'debito', 
        'endereco',
        'descricao'
    ];

    function venda() {
        return $this->hasMany(Venda::class);
    }

    function endereco() {
        return $this->hasMany(Endereco::class);
    }
}
