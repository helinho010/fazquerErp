<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prod__productos', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('idlinea')->unsigned();
            // $table->string('codigo',15);
            // $table->integer('correlativo')->unsigned();
            // $table->string('nombre',100);
            // $table->bigInteger('iddispenser')->unsigned();
            // $table->bigInteger('idcategoria')->unsigned();
            // $table->string('cantidad',15);
            // $table->bigInteger('idformafarm')->unsigned();
            // $table->string('indicaciones')->nullable();
            // $table->string('dosificacion')->nullable();
            // $table->string('accion_terapeutica')->nullable();
            // $table->string('principio_activo')->nullable();
            // $table->string('imagen')->nullable();
            // $table->tinyInteger('tiempo_pedido');
            // $table->decimal('precio_lista');
            // $table->decimal('precio_venta');
            // $table->string('metodoabc',2);
            
            $table->string('codigo')->comment('a');
            $table->unsignedBigInteger('idlinea')->comment("Identificador que hace referencia a la tabla prod__lineas");
            $table->string('nombre')->comment('a');
            $table->bigInteger('correlativo')->unsigned();
            $table->bigInteger('iddispenserprimario')->comment('a');
            $table->string('cantidadprimario')->comment('a');
            $table->bigInteger('idformafarmaceuticaprimario')->comment('a');
            $table->decimal('preciolistaprimario')->comment('a');
            $table->decimal('precioventaprimario')->comment('a');
            $table->bigInteger('tiempopedidoprimario')->comment('a');
            $table->string('metodoabcprimario')->comment('a');
            $table->boolean('tiendaprimario')->comment('a');
            $table->boolean('almacenprimario')->comment('a');
            $table->bigInteger('iddispensersecundario')->comment('a');
            $table->string('cantidadsecundario')->comment('a');
            $table->bigInteger('idformafarmaceuticasecundario')->comment('a');
            $table->decimal('preciolistasecundario')->comment('a');
            $table->decimal('precioventasecundario')->comment('a');
            $table->bigInteger('tiempopedidosecundario')->comment('a');
            $table->string('metodoabcsecundario')->comment('a');
            $table->boolean('tiendasecundario')->comment('a');
            $table->boolean('almacensecundario')->comment('a');
            $table->bigInteger('iddispenserterciario')->comment('a');
            $table->string('cantidadterciario')->comment('a');
            $table->bigInteger('idformafarmaceuticaterciario')->comment('a');
            $table->decimal('preciolistaterciario')->comment('a');
            $table->decimal('precioventaterciario')->comment('a');
            $table->bigInteger('tiempopedidoterciario')->comment('a');
            $table->string('metodoabcterciario')->comment('a');
            $table->boolean('tiendaterciario')->comment('a');
            $table->boolean('almacenterciario')->comment('a');
            $table->unsignedBigInteger('idcategoria')->comment('a');
            $table->string('indicaciones')->nullable()->comment('a');
            $table->string('dosificacion')->nullable()->comment('a');
            $table->string('principio')->nullable()->comment('a');
            $table->string('accion')->nullable()->comment('a');
            $table->string('foto')->nullable()->comment('a');
            $table->string('codigointernacional')->nullable()->comment('a');
        
            $table->tinyInteger('estado')->default(1)->comment('1->');
            $table->boolean('activo')->default(1);
            $table->smallInteger('id_usuario_registra')->unsigned()->nullable()->comment('null->viene del seeder');
            $table->smallInteger('id_usuario_modifica')->unsigned()->nullable()->comment('null->viene del seeder');
            $table->timestamps();

            $table->foreign('idlinea')->references('id')->on('prod__lineas');
            // $table->foreign('iddispenserprimario')->references('id')->on('prod__dispensers');
            // $table->foreign('iddispensersecundario')->references('id')->on('prod__dispensers');
            // $table->foreign('iddispenserterciario')->references('id')->on('prod__dispensers');
            // $table->foreign('idformafarmaceuticaprimario')->references('id')->on('prod__forma_farmaceuticas');
            // $table->foreign('idformafarmaceuticasecundario')->references('id')->on('prod__forma_farmaceuticas');
            // $table->foreign('idformafarmaceuticaterciario')->references('id')->on('prod__forma_farmaceuticas');
            $table->foreign('idcategoria')->references('id')->on('prod__categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prod__productos');
    }
}
