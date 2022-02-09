<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSetdebitoclienteFunctionTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION SetDebitoCliente()
            RETURNS TRIGGER AS $$
            
                DECLARE var_debito decimal(7,2);
                
                BEGIN
                    
                    -- verificação se o tipo da trigger é do tipo DELETE
                    IF (TG_OP = \'DELETE\') THEN
                        var_debito := (
                            SELECT sum(valor_parcela) FROM parcelas_venda
                            WHERE status = \'NP\'
                            AND pagamento_venda_id = OLD.pagamento_venda_id
                        );
                        
                        UPDATE clientes SET debito = var_debito
                        WHERE id = (
                            SELECT cliente_id FROM vendas AS v, pagamento_venda AS pv
                            WHERE v.id = pv.venda_id
                            AND pv.id = OLD.pagamento_venda_id
                        );
                    ELSE
                        var_debito := (
                            SELECT sum(valor_parcela) FROM parcelas_venda
                            WHERE status = \'NP\'
                            AND pagamento_venda_id = NEW.pagamento_venda_id
                        );
                        
                        UPDATE clientes SET debito = var_debito
                        WHERE id = (
                            SELECT cliente_id FROM vendas AS v, pagamento_venda AS pv
                            WHERE v.id= pv.venda_id
                            AND pv.id = NEW.pagamento_venda_id
                        );
                    END IF;
                    
                RETURN NULL;
                END $$
            LANGUAGE plpgsql;
            
            CREATE TRIGGER SetDebitoCliente
            AFTER INSERT OR UPDATE OR DELETE ON parcelas_venda
            FOR EACH ROW
            EXECUTE PROCEDURE SetDebitoCliente();
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
            DROP TRIGGER SetDebitoCliente ON parcelas_venda;
            DROP FUNCTION SetDebitoCliente();
        ');
    }
}
