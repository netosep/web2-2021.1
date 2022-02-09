<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDelvalorcaixaFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION DelValorEmCaixa()
            RETURNS TRIGGER AS $$
                BEGIN
                
                    UPDATE caixas SET valor_em_caixa = valor_em_caixa - OLD.valor_total WHERE id = OLD.caixa_id;
                
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER DelValorEmCaixa
            AFTER DELETE ON vendas
            FOR EACH ROW
            EXECUTE PROCEDURE DelValorEmCaixa();
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
            DROP TRIGGER DelValorEmCaixa ON vendas;
            DROP FUNCTION DelValorEmCaixa();
        ');
    }
}
