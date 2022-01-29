<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $fillable = [
        'nome_cliente',
        'cpf',
        'ativo'
    ];

    public function contatos()
    {
        return $this->hasMany(Contato::class);
    }
    
    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

    public function venda()
    {
        return $this->hasMany(Venda::class);
    }
    
}
