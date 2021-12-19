<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelasVendaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcelas_venda', function (Blueprint $table) {
            $table->id('parcela_venda_id');
            $table->unsignedBigInteger('pagamento_venda_id');
            $table->integer('numero_parcela');
            $table->date('data_vencimento');
            $table->double('valor_parcela');
            $table->double('valor_pago');
            $table->char('status', 2);
            $table->timestamps();

            $table->foreign('pagamento_venda_id')->references('pagamento_venda_id')->on('pagamento_venda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcelas_venda');
    }
}
