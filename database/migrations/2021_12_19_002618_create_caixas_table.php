<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCaixasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caixas', function (Blueprint $table) {
            $table->id();
            $table->string('identificador')->nullable();
            $table->double('valor_em_caixa')->default(0);
            $table->char('status', 1)->default('F'); // A = Aberto, F = Fechado
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        DB::table('caixas')->insert([
            'identificador' => 'CAIXA ADMIN',
            'status' => 'A'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('caixas');
    }
}
