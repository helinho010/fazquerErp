<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmModulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adm__modulos', function (Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('nombre',50);
            $table->boolean('activo')->default(1);
            $table->boolean('contabilizable')->default(0);
            $table->bigInteger('id_usuario_registra')->unsigned();
            $table->bigInteger('id_usuario_modifica')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('id_usuario_registra')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adm__modulos');
    }
}
