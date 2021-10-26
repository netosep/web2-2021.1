<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    use HasFactory;
    protected $table = 'itens_venda';
    protected $fillable = [
        'venda_id', 
        'produto_id',
        'quantidade', 
        'valor_unitario', 
        'valor_total'
    ];

    public function venda() {
        return $this->belongsTo(Venda::class);
    }
}
