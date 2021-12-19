<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelasCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcelas_compra', function (Blueprint $table) {
            $table->id('parcela_compra_id');
            $table->unsignedBigInteger('pagamento_compra_id');
            $table->integer('numero_parcela');
            $table->date('data_vencimento');
            $table->double('valor_parcela');
            $table->double('valor_pago');
            $table->char('status', 2);
            $table->timestamps();

            $table->foreign('pagamento_compra_id')->references('pagamento_compra_id')->on('pagamento_compra');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parcelas_compra');
    }
}
