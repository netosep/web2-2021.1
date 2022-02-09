<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentoCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamento_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('forma_pagamento_id');
            $table->integer('parcelas')->default(1);
            $table->integer('prazo_dias')->default(30);
            $table->double('valor_pago')->default(0);
            $table->double('valor_a_pagar')->default(0);
            $table->char('status', 2)->default('NP'); // NP = Não Pago, EP = Em Pagamento, PG = Pago, VL = Vencido, CA = Cancelado
            $table->timestamps();

            $table->foreign('compra_id')->references('id')->on('compras')->onDelete('cascade');
            $table->foreign('forma_pagamento_id')->references('id')->on('formas_pagamento')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamento_compra');
    }
}
