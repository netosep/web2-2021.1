<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateProdutoabaixoestoqueFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION produtosAbaixoEstoque(int)
            RETURNS TABLE (produto_id int8, nome VARCHAR, estoque DOUBLE PRECISION, preco_venda DOUBLE PRECISION) AS $$
                BEGIN
                    RETURN QUERY SELECT id, nome_produto, quantidade, valor_venda FROM produtos
                    WHERE quantidade <= $1;
                END $$
            LANGUAGE plpgsql;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
            DROP FUNCTION produtosAbaixoEstoque;
        ');
    }
}
