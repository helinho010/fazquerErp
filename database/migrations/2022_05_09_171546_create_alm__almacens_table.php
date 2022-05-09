<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlmAlmacensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alm__almacens', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('idsucursal')->unsigned();
            $table->bigInteger('idproducto')->unsigned();
            $table->bigInteger('idusuario');
            $table->integer('cantidad')->unsigned();
            $table->string('tipo_entrada',50)->default('Compra');
            $table->string('lote',100);
            $table->date('fecha_vencimiento');
            $table->string('codigo',100)->nullable();
            $table->string('registro_sanitario',100);
            $table->string('ubicacion_estante',20);
            $table->boolean('activo')->default(1);
            $table->tinyInteger('estado')->default(1)->comment('1->');
            $table->timestamps();
            $table->foreign('idsucursal')->references('id')->on('adm__sucursals');
            $table->foreign('idproducto')->references('id')->on('prod__productos');
            $table->smallInteger('id_usuario_registra')->unsigned()->nullable()->comment('null->viene del seeder');
            $table->smallInteger('id_usuario_modifica')->unsigned()->nullable()->comment('null->viene del seeder');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alm__almacens');
    }
}
