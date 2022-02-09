<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDeldevolucaoFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION DelDevolucao()
            RETURNS TRIGGER AS $$
                BEGIN
                
                    UPDATE clientes SET credito = credito - (OLD.quantidade * (SELECT valor_unitario FROM itens_venda WHERE id = OLD.item_venda_id))
                    WHERE id = (
                        SELECT C.id FROM clientes AS C, vendas AS V, itens_venda AS IV
                        WHERE C.id = V.cliente_id
                        AND V.id = IV.venda_id
                        AND IV.id = OLD.item_venda_id
                    );
                            
                    UPDATE itens_venda SET quantidade = quantidade + OLD.quantidade WHERE id = OLD.item_venda_id;
                
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER DelDevolucao
            AFTER DELETE ON devolucoes
            FOR EACH ROW
            EXECUTE PROCEDURE DelDevolucao();        
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
            DROP TRIGGER DelDevolucao ON devolucoes;
            DROP FUNCTION DelDevolucao();
        ');
    }
}
