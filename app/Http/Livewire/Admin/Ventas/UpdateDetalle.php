<?php

namespace App\Http\Livewire\Admin\Ventas;

use App\Models\DetalleVenta;
use App\Models\Producto;
use Livewire\Component;

class UpdateDetalle extends Component
{
    public $detalleVenta;
    public $cantidad, $venta, $descuento, $subtotal, $impuesto;
    public $stock, $producto_id, $maximo;

    protected function rules()
    {
        return [
            'cantidad' =>  ['required', 'min:1', 'numeric', 'max:' . $this->maximo],
            'venta' =>  ['required', 'min:1', 'numeric', 'max:999999999'],
            'descuento' =>  ['required', 'min:0', 'numeric', 'max:' . $this->impuesto],
        ];
    }

    public function mount(DetalleVenta $detalleVenta)
    {
        $this->detalleVenta = $detalleVenta;
        $this->cantidad = $this->detalleVenta->cantidad;
        $this->venta = $this->detalleVenta->precio_venta;
        $this->descuento = $this->detalleVenta->descuento;
        $this->impuesto = $this->venta * 0.13;
    }
    public function updatedCantidad()
    {
        $this->validate();
        $this->detalleVenta->cantidad = $this->cantidad;
        $this->detalleVenta->subtotal = ($this->detalleVenta->cantidad * $this->detalleVenta->precio_venta) - $this->detalleVenta->descuento;
        $this->detalleVenta->save();
        $this->emitTo('admin.ventas.create-venta', 'render');
    }
    public function updatedVenta()
    {
        $this->validate();
        $this->detalleVenta->precio_venta = $this->venta;
        $this->detalleVenta->subtotal = ($this->detalleVenta->cantidad * $this->detalleVenta->precio_venta) - $this->detalleVenta->descuento;
        $this->detalleVenta->save();
        $this->emitTo('admin.ventas.create-venta', 'render');
    }
    public function updatedDescuento()
    {
        $this->validate();
        $this->detalleVenta->descuento = $this->descuento;
        $this->detalleVenta->subtotal = ($this->detalleVenta->cantidad * $this->detalleVenta->precio_venta) - $this->detalleVenta->descuento;
        $this->detalleVenta->save();
        $this->emitTo('admin.ventas.create-venta', 'render');
    }
    public function update()
    {
        $this->validate();
        $this->detalleVenta->cantidad = $this->cantidad;
        $this->detalleVenta->precio_venta = $this->venta;
        $this->detalleVenta->descuento = $this->descuento;
        $this->detalleVenta->subtotal = ($this->detalleVenta->cantidad * $this->detalleVenta->precio_venta) - $this->detalleVenta->descuento;
        $this->detalleVenta->save();
        $this->emitTo('admin.ventas.create-venta', 'render');
        $this->emit('alert', 'Actualizado');
    }
    public function destroy()
    {
        $this->detalleVenta->delete();
        $this->emitTo('admin.ventas.create-venta', 'render');
    }
    public function render()
    {
        $this->stock = Producto::select('stock')->where('id', $this->detalleVenta->producto_id)->first();
        $this->maximo = $this->stock->stock;
        return view('livewire.admin.ventas.update-detalle');
    }
}
