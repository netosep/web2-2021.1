<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $table = 'funcionarios';
    protected $fillable = [
        'nome_funcionario',
        'cpf',
        'telefone',
        'email',
        'endereco_completo',
        'cargo',
        'salario',
        'usuario',
        'nivel_acesso',
        'caixa_id',
        'senha',
        'ativo'
    ];
    protected $hidden = [
        'usuario',
        'senha'
    ];

    public function caixa()
    {
        return $this->belongsTo(Caixa::class);
    }

}
