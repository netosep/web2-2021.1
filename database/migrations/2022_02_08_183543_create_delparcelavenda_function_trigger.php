<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateDelparcelavendaFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION DelParcelasVenda()
            RETURNS TRIGGER AS $$
                
                BEGIN
                
                    DELETE FROM parcelas_venda WHERE pagamento_venda_id = OLD.id;
            
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER DelParcelasVenda
            AFTER DELETE ON pagamento_venda
            FOR EACH ROW
            EXECUTE PROCEDURE DelParcelasVenda();
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
            DROP TRIGGER DelParcelasVenda ON pagamento_venda;
            DROP FUNCTION DelParcelasVenda();
        ');
    }
}
