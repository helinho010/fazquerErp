<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRrhEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rrh__empleados', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('codempleado',12)->nullable();
            $table->string('nombre',50);
            $table->string('apaterno',50)->nullable();
            $table->string('amaterno',50)->nullable();
            $table->string('sexo',1);
            $table->string('ci',12)->nullable();
            $table->string('foto',150)->nullable();
            $table->string('telefonos',100)->nullable();
            $table->date('fechanacimiento')->nullable();
            $table->string('estadocivil')->nullable();
            $table->smallInteger('idformacion')->unsigned(); 
            $table->smallInteger('idprofesion')->unsigned();
            $table->smallinteger('idcargo')->unsigned();
            $table->string('domicilio',50)->nullable();
            $table->string('ciudad',30)->nullable();
            $table->date('fechaingreso')->nullable();
            $table->date('fecharetiro')->nullable();
            $table->string('nrcuenta',20)->nullable();
            $table->string('obs',150)->nullable();
            $table->boolean('activo')->default(1);
            $table->smallInteger('id_usuario_registra')->unsigned()->nullable()->comment('null->viene del seeder');
            $table->smallInteger('id_usuario_modifica')->unsigned()->nullable()->comment('null->viene del seeder');
            $table->timestamps();

            $table->foreign('idformacion')->references('id')->on('rrh__formacions');
            $table->foreign('idprofesion')->references('id')->on('rrh__profesions');
            $table->foreign('idcargo')->references('id')->on('rrh__cargos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rrh__empleados');
    }
}
