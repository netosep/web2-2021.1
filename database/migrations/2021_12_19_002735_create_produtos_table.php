<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id('produto_id');
            $table->unsignedBigInteger('categoria_id');
            $table->string('nome_produto');
            $table->string('descricao_produto');
            $table->double('icms')->default(0);
            $table->double('frete')->default(0);
            $table->double('acrescimo_despesas')->default(0);
            $table->double('valor_fabrica')->default(0);
            $table->double('valor_compra')->default(0);
            $table->double('valor_venda')->default(0);
            $table->double('lucro')->default(0);
            $table->double('desconto')->default(0);
            $table->double('quantidade')->default(0);
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->foreign('categoria_id')->references('categoria_id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
