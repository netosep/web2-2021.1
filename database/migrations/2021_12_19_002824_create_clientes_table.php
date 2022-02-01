<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nome_cliente');
            $table->string('cpf');
            $table->double('credito')->default(0);
            $table->double('debito')->default(0);
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        DB::table('clientes')->insert([
            'nome_cliente' => 'Cliente Padrão',
            'cpf' => '00000000000',
            'credito' => 0,
            'debito' => 0,
            'ativo' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}
