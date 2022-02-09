<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAttcompraFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION AttCompra()
            RETURNS TRIGGER AS $$
            
                -- lucro hipotetico de 40% encima de cada produto
                DECLARE var_acrescimo_despesas numeric(7,2) := (0.4);
                DECLARE quant_estoque int4 := (SELECT quantidade FROM produtos WHERE id = NEW.produto_id);
            
                BEGIN
                
                    UPDATE compras
                    SET valor_total = valor_total - (
                        (OLD.quantidade * (OLD.valor_compra + (OLD.valor_compra * (OLD.icms + OLD.ipi + OLD.frete)))) -
                        (NEW.quantidade * (NEW.valor_compra + (NEW.valor_compra * (NEW.icms + NEW.ipi + NEW.frete))))
                    )
                    WHERE id = NEW.compra_id;
            
                    UPDATE produtos
                    SET icms = icms - (OLD.icms - NEW.icms),
                        ipi = ipi - (OLD.ipi - NEW.ipi),
                        frete = frete - (OLD.frete - NEW.frete),
                        valor_compra = valor_compra - (
                            (OLD.valor_compra + (OLD.valor_compra * (OLD.icms + OLD.ipi + OLD.frete))) -
                            (NEW.valor_compra + (NEW.valor_compra * (NEW.icms + NEW.ipi + NEW.frete)))
                        ),
                        valor_fabrica = valor_fabrica - (OLD.valor_compra - NEW.valor_compra),
                        valor_venda = valor_venda - (
                            (OLD.valor_compra + (OLD.valor_compra * (OLD.icms + OLD.ipi + OLD.frete + var_acrescimo_despesas))) -
                            (NEW.valor_compra + (NEW.valor_compra * (NEW.icms + NEW.ipi + NEW.frete + var_acrescimo_despesas)))
                        ),
                        quantidade = quantidade - (OLD.quantidade - NEW.quantidade)
                    WHERE id = NEW.produto_id;
                
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER AttCompra
            AFTER UPDATE ON itens_compra
            FOR EACH ROW
            EXECUTE PROCEDURE AttCompra();
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
            DROP TRIGGER AttCompra ON itens_compra;
            DROP FUNCTION AttCompra;
        ');
    }
}
