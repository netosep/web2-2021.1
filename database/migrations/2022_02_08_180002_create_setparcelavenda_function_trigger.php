<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSetparcelavendaFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION SetParcelasVenda()
            RETURNS TRIGGER AS $$
            
                DECLARE parcela int4 := 1;
                DECLARE data_parcela int4 := 30;
                
                BEGIN
                
                    WHILE parcela <= NEW.parcelas LOOP
                    
                        INSERT INTO parcelas_venda (pagamento_venda_id, numero_parcela, valor_parcela, data_vencimento, status)
                        VALUES (NEW.id, parcela, (NEW.valor_a_pagar / NEW.parcelas), (CURRENT_DATE + data_parcela), \'NP\');
                        
                        data_parcela := data_parcela + 30;
                        parcela := parcela + 1;
                        
                    END LOOP;
            
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER SetParcelasVenda
            AFTER INSERT ON pagamento_venda
            FOR EACH ROW
            EXECUTE PROCEDURE SetParcelasVenda();
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
            DROP TRIGGER SetParcelasVenda ON pagamento_venda;
            DROP FUNCTION SetParcelasVenda();
        ');
    }
}
