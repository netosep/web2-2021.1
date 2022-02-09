<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAttvalorcaixaFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION AttValorEmCaixa()
            RETURNS TRIGGER AS $$
                BEGIN
                
                    UPDATE caixas SET valor_em_caixa = valor_em_caixa - (OLD.valor_total - NEW.valor_total) WHERE id = NEW.caixa_id;
                
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER AttValorEmCaixa
            AFTER UPDATE ON vendas
            FOR EACH ROW
            EXECUTE PROCEDURE AttValorEmCaixa();
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
            DROP TRIGGER AttValorEmCaixa ON vendas;
            DROP FUNCTION AttValorEmCaixa();
        ');
    }
}
