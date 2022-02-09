<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSetdevolucaoFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION SetDevolucao()
            RETURNS TRIGGER AS $$
            
                DECLARE quantidade_vendida int4 := (SELECT quantidade FROM itens_venda WHERE id = NEW.item_venda_id);
                
                BEGIN
                
                    IF NEW.quantidade > quantidade_vendida THEN
                        RAISE EXCEPTION \'A quantidade a ser devolvida (%) é maior que a quantidade vendida (%)\', NEW.quantidade, quantidade_vendida;
                    ELSE
                        
                        UPDATE clientes SET credito = credito + (NEW.quantidade * (SELECT valor_unitario FROM itens_venda WHERE id = NEW.item_venda_id))
                        WHERE id = (
                            SELECT C.id FROM clientes AS C, vendas AS V, itens_venda AS IV
                            WHERE C.id = V.cliente_id
                            AND V.id = IV.venda_id
                            AND IV.id = NEW.item_venda_id
                        );
                        
                        UPDATE itens_venda SET quantidade = quantidade - NEW.quantidade WHERE id = NEW.item_venda_id;
                        
                    END IF;
            
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER SetDevolucao
            AFTER INSERT ON devolucoes
            FOR EACH ROW
            EXECUTE PROCEDURE SetDevolucao();
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
            DROP TRIGGER SetDevolucao ON devolucoes;
            DROP FUNCTION SetDevolucao();
        ');
    }
}
