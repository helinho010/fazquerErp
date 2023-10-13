<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ges_pre__ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idalmingresoproducto')->comment('identifcador unico que hace referencia al id de la tabla alm__ingreso_producto');
            // $table->integer('cantidad_utilidad')->comment('');
            // $table->decimal('precio_lista_utilidad', $precision = 8, $scale = 2)->comment('');
            // $table->integer('cantidad_total_utilidad')->comment('');
            // $table->decimal('precio_compra_utilidad', $precision = 8, $scale = 2)->comment('');
            // $table->decimal('margen_30p_utilidad', $precision = 8, $scale = 2)->comment('');
            // $table->decimal('margen_40p_utilidad', $precision = 8, $scale = 2)->comment('');
            // $table->decimal('precio_venta_utilidad', $precision = 8, $scale = 2)->comment('');
            // $table->decimal('neto_utilidad', $precision = 8, $scale = 2)->comment('');
            $table->integer('idusuario')->comment('');
            $table->timestamps();
            $table->foreign('idalmingresoproducto')->references('id')->on('alm__ingreso_producto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ges_pre__ventas');
    }
};
