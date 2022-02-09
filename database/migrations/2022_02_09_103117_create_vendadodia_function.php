<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateVendadodiaFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE OR REPLACE FUNCTION vendaDoDia(date)
            RETURNS TABLE (total_venda_dia DOUBLE PRECISION) AS $$
                BEGIN
                    RETURN QUERY SELECT sum(valor_total) FROM vendas
                    WHERE (CAST (created_at AS DATE) = $1)
                    GROUP BY created_at;
                END $$
            LANGUAGE plpgsql;
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
            DROP FUNCTION vendaDoDia;
        ');
    }
}
