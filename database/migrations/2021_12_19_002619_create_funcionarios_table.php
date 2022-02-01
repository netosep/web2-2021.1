<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome_funcionario');
            $table->string('cpf');
            $table->string('telefone');
            $table->string('usuario')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('senha')->nullable();
            $table->integer('nivel_acesso')->nullable(); // 1 = ADMIN, 2 = CAIXA
            $table->unsignedBigInteger('caixa_id')->nullable();
            $table->string('endereco_completo');
            $table->string('cargo');
            $table->double('salario')->default(0);
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->foreign('caixa_id')->references('id')->on('caixas')->onDelete('cascade');
        });

        DB::table('funcionarios')->insert([
            'nome_funcionario' => 'ADMIN',
            'cpf' => '00000000000',
            'telefone' => '00000000000',
            'usuario' => 'admin',
            'email' => 'admin@sisconve.com',
            'senha' => Hash::make('admin'),
            'nivel_acesso' => 1, 
            'caixa_id' => 1,
            'endereco_completo' => 'ADMIN',
            'cargo' => 'ADMIN',
            'ativo' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
