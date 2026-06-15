<?php

namespace App\Http\Livewire\Admin\Cotizacion;

use App\Models\DetalleCotizacion;
use Livewire\Component;

class UpdateDetalleCotizacion extends Component
{
    public $detalleCotizacion;
    public $cantidad, $venta, $descuento, $subtotal, $impuesto;
    
    protected function rules()
    {
        return [
            'cantidad' =>  ['required', 'min:1', 'numeric', 'max:999999999'],
            'venta' =>  ['required', 'min:1', 'numeric', 'max:999999999'],
            'descuento' =>  ['required', 'min:0', 'numeric', 'max:' . $this->impuesto],
        ];
    }

    public function mount(DetalleCotizacion $detalleCotizacion)
    {
        $this->detalleCotizacion = $detalleCotizacion;
        $this->cantidad = $this->detalleCotizacion->cantidad;
        $this->venta = $this->detalleCotizacion->precio_venta;
        $this->descuento = $this->detalleCotizacion->descuento;
        $this->impuesto = $this->venta * 0.13;
    }
    public function updatedCantidad()
    {
        $this->validate();
        $this->detalleCotizacion->cantidad = $this->cantidad;
        $this->detalleCotizacion->subtotal = ($this->detalleCotizacion->cantidad * $this->detalleCotizacion->precio_venta) - $this->detalleCotizacion->descuento;
        $this->detalleCotizacion->save();
        $this->emitTo('admin.cotizacion.create-cotizacions', 'render');
    }
    public function updatedVenta()
    {
        $this->validate();
        $this->detalleCotizacion->precio_venta = $this->venta;
        $this->detalleCotizacion->subtotal = ($this->detalleCotizacion->cantidad * $this->detalleCotizacion->precio_venta) - $this->detalleCotizacion->descuento;
        $this->detalleCotizacion->save();
        $this->emitTo('admin.cotizacion.create-cotizacions', 'render');
    }
    public function updatedDescuento()
    {
        $this->validate();
        $this->detalleCotizacion->descuento = $this->descuento;
        $this->detalleCotizacion->subtotal = ($this->detalleCotizacion->cantidad * $this->detalleCotizacion->precio_venta) - $this->detalleCotizacion->descuento;
        $this->detalleCotizacion->save();
        $this->emitTo('admin.cotizacion.create-cotizacions', 'render');
    }
    public function update()
    {
        $this->validate();
        $this->detalleCotizacion->cantidad = $this->cantidad;
        $this->detalleCotizacion->precio_venta = $this->venta;
        $this->detalleCotizacion->descuento = $this->descuento;
        $this->detalleCotizacion->subtotal = ($this->detalleCotizacion->cantidad * $this->detalleCotizacion->precio_venta) - $this->detalleCotizacion->descuento;
        $this->detalleCotizacion->save();
        $this->emitTo('admin.cotizacion.create-cotizacions', 'render');
        $this->emit('alert', 'Actualizado');
    }
    public function destroy()
    {
        $this->detalleCotizacion->delete();
        $this->emitTo('admin.cotizacion.create-cotizacions', 'render');
    }
    public function render()
    {
        return view('livewire.admin.cotizacion.update-detalle-cotizacion');
    }
}
