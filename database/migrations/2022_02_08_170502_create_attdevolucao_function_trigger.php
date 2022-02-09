<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAttdevolucaoFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION AttDevolucao()
            RETURNS TRIGGER AS $$
            
                DECLARE quantidade_vendida int4 := (SELECT quantidade FROM itens_venda WHERE id = NEW.item_venda_id);
            
                BEGIN
                
                    IF (quantidade_vendida + (OLD.quantidade - NEW.quantidade)) < 0 THEN
                        RAISE EXCEPTION \'A quantidade a ser devolvida (%) é maior que a quantidade vendida (%)\', NEW.quantidade, quantidade_vendida;
                    ELSE
                    
                        UPDATE clientes SET credito = credito + (
                            (NEW.quantidade * (SELECT valor_unitario FROM itens_venda WHERE id = NEW.item_venda_id)) - 
                            (OLD.quantidade * (SELECT valor_unitario FROM itens_venda WHERE id = NEW.item_venda_id))
                        )
                        WHERE id = (
                            SELECT C.id FROM clientes AS C, vendas AS V, itens_venda AS IV
                            WHERE C.id = V.cliente_id
                            AND V.id = IV.venda_id
                            AND IV.id = NEW.item_venda_id
                        );
                        
                        UPDATE itens_venda SET quantidade = quantidade + (OLD.quantidade - NEW.quantidade) WHERE id = NEW.item_venda_id;
                        
                    END IF;
                
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER AttDevolucao
            AFTER UPDATE ON devolucoes
            FOR EACH ROW
            EXECUTE PROCEDURE AttDevolucao();
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
            DROP TRIGGER AttDevolucao ON devolucoes;
            DROP FUNCTION AttDevolucao();
        ');
    }
}
