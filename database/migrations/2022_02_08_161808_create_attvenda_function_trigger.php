<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAttvendaFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION AttVenda()
            RETURNS TRIGGER AS $$
                
                DECLARE quantidade_estoque int4 := (SELECT quantidade FROM produtos WHERE id = NEW.produto_id);
                DECLARE var_valor_compra decimal(7,2) := (SELECT valor_compra FROM produtos WHERE id = NEW.produto_id);
            
                BEGIN
                
                    IF (quantidade_estoque + (OLD.quantidade - NEW.quantidade)) < 0 THEN
                        RAISE EXCEPTION \'A quantidade a ser vendida (%) é maior que a quantidade em estoque (%)\', NEW.quantidade, quantidade_estoque;
                    ELSE
                        UPDATE vendas SET valor_total = valor_total - ((OLD.quantidade * OLD.valor_unitario) - (NEW.quantidade * NEW.valor_unitario)) WHERE id = OLD.venda_id;
                        UPDATE produtos
                        SET quantidade = quantidade + (OLD.quantidade - NEW.quantidade),
                            lucro = lucro - (
                                ((OLD.valor_unitario - var_valor_compra) * OLD.quantidade) -
                                ((NEW.valor_unitario - var_valor_compra) * NEW.quantidade)
                            )
                        WHERE id = NEW.produto_id;
                    END IF;
                    
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER AttVenda
            AFTER UPDATE ON itens_venda
            FOR EACH ROW
            EXECUTE PROCEDURE AttVenda();
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
            DROP TRIGGER AttVenda ON itens_venda;
            DROP FUNCTION AttVenda();
        ');
    }
}
