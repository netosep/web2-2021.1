<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->id('funcionario_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nome_funcionario');
            $table->string('cpf');
            $table->string('telefone');
            $table->string('endereco_completo');
            $table->string('cargo');
            $table->double('salario')->default(0);
            $table->boolean('ativo')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users');
        });
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
