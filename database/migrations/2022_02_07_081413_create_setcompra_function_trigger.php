<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSetcompraFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION SetCompra()
            RETURNS TRIGGER AS $$

                -- lucro hipotetico de 40% encima de cada produto
                DECLARE var_acrescimo_despesas numeric(7,2) := (0.4);

                BEGIN
                    
                    UPDATE compras 
                    SET valor_total = valor_total + (NEW.quantidade * (NEW.valor_compra + (NEW.valor_compra * (NEW.icms + NEW.ipi + NEW.frete))))
                    WHERE id = NEW.compra_id;

                    UPDATE produtos
                    SET icms = NEW.icms,
                        ipi = NEW.ipi,
                        frete = NEW.frete,
                        acrescimo_despesas = var_acrescimo_despesas,
                        valor_compra = NEW.valor_compra + (NEW.valor_compra * (NEW.icms + NEW.ipi + NEW.frete)),
                        valor_fabrica = NEW.valor_compra,
                        valor_venda = NEW.valor_compra + (NEW.valor_compra * (NEW.icms + NEW.ipi + NEW.frete + var_acrescimo_despesas)),
                        quantidade = quantidade + NEW.quantidade
                    WHERE id = NEW.produto_id;
                
                    RETURN NULL;
                END $$
            LANGUAGE plpgsql;

            CREATE TRIGGER SetCompra
            AFTER INSERT ON itens_compra
            FOR EACH ROW
            EXECUTE PROCEDURE SetCompra();
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
            DROP TRIGGER SetCompra ON itens_compra;
            DROP FUNCTION SetCompra;
        ');
    }
}
