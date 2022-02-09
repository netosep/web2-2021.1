<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDelcompraFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION DelCompra()
            RETURNS TRIGGER AS $$
                BEGIN
                
                    UPDATE compras 
                    SET valor_total = valor_total - (
                        OLD.quantidade * (OLD.valor_compra + (OLD.valor_compra * (OLD.icms + OLD.ipi + OLD.frete)))
                    )
                    WHERE id = OLD.compra_id;
                    
                    UPDATE produtos SET quantidade = quantidade - OLD.quantidade WHERE id = OLD.produto_id;
                
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;

            CREATE TRIGGER DelCompra
            AFTER DELETE ON itens_compra
            FOR EACH ROW
            EXECUTE PROCEDURE DelCompra();
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
            DROP TRIGGER DelCompra ON itens_compra;
            DROP FUNCTION DelCompra();
        ');
    }
}
