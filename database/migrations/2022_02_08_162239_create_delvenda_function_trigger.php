<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDelvendaFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION DelVenda()
            RETURNS TRIGGER AS $$
            
                DECLARE var_preco_compra decimal(7,2) := (SELECT valor_compra FROM produtos WHERE id = OLD.produto_id);
                
                BEGIN
                
                    UPDATE vendas SET valor_total = valor_total - (OLD.quantidade * OLD.valor_unitario) WHERE id = OLD.venda_id;
                    UPDATE produtos
                    SET quantidade = quantidade + OLD.quantidade,
                        lucro = lucro - ((OLD.valor_unitario - var_preco_compra) * OLD.quantidade)
                    WHERE id = OLD.produto_id;
                
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER DelVenda
            AFTER DELETE ON itens_venda
            FOR EACH ROW
            EXECUTE PROCEDURE DelVenda();
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
            DROP TRIGGER DelVenda ON itens_venda;
            DROP FUNCTION DelVenda();      
        ');
    }
}
