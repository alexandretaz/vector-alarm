<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeClientTableAddExtraData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients',function (Blueprint $table) {
            $table->char('cpf',14)->unique();
            $table->string('rg')->index();
            $table->string('tel_com')->nullable();
            $table->string('tel_res')->nullable();
            $table->string('tel_cel')->nullable();
            $table->string('grau_parentesco')->nullable();
            $table->json('veiculo')->nullable();
            $table->json('contatos_prioridade')->nullable();
            $table->json('contatos_autorizados')->nullable();
            $table->string('senha')->nullable();
            $table->string('contrasenha')->nullable();
            $table->text('procedimentos_especiais')->nullable();



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function(Blueprint $table) {
           $table->removeColumn('cpf');
            $table->removeColumn('rg');
            $table->removeColumn('tel_com');
            $table->removeColumn('tel_res');
            $table->removeColumn('tel_cel');
            $table->removeColumn('grau_parentesco');
            $table->removeColumn('veículo');
            $table->removeColumn('contatos_prioridade');
            $table->removeColumn('contatos_autorizados');
            $table->removeColumn('senha');
            $table->removeColumn('contrasenha');
            $table->removeColumn('procedimentos_especiais');
        });
    }
}
