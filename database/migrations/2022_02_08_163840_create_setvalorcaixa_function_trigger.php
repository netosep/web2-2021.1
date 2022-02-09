<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSetvalorcaixaFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION SetValorEmCaixa()
            RETURNS TRIGGER AS $$
                BEGIN
                
                    UPDATE caixas SET valor_em_caixa = valor_em_caixa + NEW.valor_total WHERE id = NEW.caixa_id;
                
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER SetValorEmCaixa
            AFTER INSERT ON vendas
            FOR EACH ROW
            EXECUTE PROCEDURE SetValorEmCaixa();        
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
            DROP TRIGGER SetValorEmCaixa ON vendas;
            DROP FUNCTION SetValorEmCaixa();
        ');
    }
}
