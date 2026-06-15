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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->string('nombre')->unique();
            $table->string('slug');
            $table->string('marca');
            $table->string('medida');
            $table->integer('stock');
            $table->integer('stock_inicial');
            $table->decimal('precio_compra', $precision = 11, $scale = 2);
            $table->decimal('precio_venta', $precision = 11, $scale = 2);
            $table->decimal('precio_unitario', $precision = 11, $scale = 2);
            $table->longText('descripcion');
            $table->string('condicion');
            $table->string('image')->nullable();
            $table->decimal('kardex', $precision = 11, $scale = 2)->nullable();
            $table->decimal('compras', $precision = 11, $scale = 2)->nullable();
            $table->decimal('ventas', $precision = 11, $scale = 2)->nullable();
            $table->decimal('descuentos', $precision = 11, $scale = 2)->nullable();

            $table->unsignedBigInteger('subcategoria_id')->nullable();
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias')->onDelete('set null');
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
        Schema::dropIfExists('productos');
    }
};
