<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caixa extends Model
{
    use HasFactory;

    protected $table = 'caixas';
    protected $fillable = [
        'funcionario_id',
        'identificador',
        'status',
        'ativo'
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }
}
