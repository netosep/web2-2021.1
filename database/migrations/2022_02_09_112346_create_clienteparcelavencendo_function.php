<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateClienteparcelavencendoFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION clienteParcelaVencendo(date)
            RETURNS TABLE (cliente_id int8, nome varchar, vencimento date, parcela int4, valor double PRECISION) AS $$
                BEGIN
                    RETURN QUERY SELECT cli.id, cli.nome_cliente, par.data_vencimento, par.numero_parcela, par.valor_parcela
                FROM clientes AS cli, parcelas_venda AS par, vendas AS ven, pagamento_venda AS pv
                WHERE cli.id = ven.cliente_id
                    AND ven.id = pv.venda_id
                AND pv.id = par.pagamento_venda_id
                    AND par.data_vencimento = $1;
                END $$
            LANGUAGE  plpgsql;
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
            DROP FUNCTION clienteParcelaVencendo(date);
        ');
    }
}
