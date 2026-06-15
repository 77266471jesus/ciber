<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha');
            $table->string('detalle');
            $table->decimal('costo_unitario', $precision = 11, $scale = 2)->nullable();
            $table->integer('cantidad_entrada')->nullable();
            $table->integer('cantidad_salida')->nullable();
            $table->decimal('precio_entrada', $precision = 11, $scale = 2)->nullable();
            $table->decimal('precio_salida', $precision = 11, $scale = 2)->nullable();
            $table->integer('cantidad_total')->nullable();
            $table->decimal('precio_total', $precision = 11, $scale = 2)->nullable();
            $table->integer('cantidad')->nullable();
            $table->integer('cantidad_detalle')->nullable();
            $table->string('estado')->nullable();
            $table->longText('egreso_detalle')->nullable();
            $table->string('inicio')->nullable();
            
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('set null');            
            $table->unsignedBigInteger('ingreso_id')->nullable();
            $table->foreign('ingreso_id')->references('id')->on('ingresos')->onDelete('set null');
            $table->unsignedBigInteger('venta_id')->nullable();
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kardexes');
    }
};
