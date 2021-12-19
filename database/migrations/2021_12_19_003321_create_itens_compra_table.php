<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_compra', function (Blueprint $table) {
            $table->id('item_compra_id');
            $table->unsignedBigInteger('compra_id');
            $table->unsignedBigInteger('produto_id');
            $table->double('ipi')->default(0);
            $table->double('icms')->default(0);
            $table->double('frete')->default(0);
            $table->double('valor_compra')->default(0);
            $table->double('quantidade')->default(0);
            $table->timestamps();

            $table->foreign('compra_id')->references('compra_id')->on('compras');
            $table->foreign('produto_id')->references('produto_id')->on('produtos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens_compra');
    }
}
