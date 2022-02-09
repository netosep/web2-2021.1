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
            $table->id();
            $table->unsignedBigInteger('pagamento_venda_id');
            $table->integer('numero_parcela');
            $table->date('data_vencimento');
            $table->double('valor_parcela')->default(0);
            $table->double('valor_pago')->default(0);
            $table->char('status', 2);
            $table->timestamps();

            $table->foreign('pagamento_venda_id')->references('id')->on('pagamento_venda')->onDelete('cascade');
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
