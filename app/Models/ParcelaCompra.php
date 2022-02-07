<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelaCompra extends Model
{
    use HasFactory;

    protected $table = 'parcelas_compra';
    protected $fillable = [
        'pagamento_compra_id',
        'numero_parcela',
        'data_vencimento',
        'valor_parcela',
        'valor_pago',
        'status'
    ];

    public function pagamentoCompra()
    {
        return $this->belongsTo(PagamentoCompra::class);
    }
    
}
