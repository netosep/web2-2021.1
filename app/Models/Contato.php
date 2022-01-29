<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $table = 'contatos';
    protected $fillable = [
        'cliente_id',
        'ddd',
        'numero_telefone'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
