<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $table = 'compras';
    protected $fillable = [
        'fornecedor_id',
        'valor_total',
        'quantidade',
        'valor_compra'
    ];

    public function fornecedor() {
        return $this->belongsTo(Fornecedor::class);
    }

    public function itensCompra() {
        return $this->hasMany(ItemCompra::class);
    }
}
