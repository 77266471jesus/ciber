<?php

namespace App\Http\Livewire\Admin\Ingresos;

use App\Models\DetalleIngreso;
use Livewire\Component;

class Update extends Component
{
    public $detalleIngreso;
    public $cantidad, $compra, $venta, $subtotal;

    // protected $rules = [        
    //     'cantidad' =>  ['required', 'min:1', 'numeric', 'max:999999999'], 
    //     'compra' =>  ['required', 'min:1', 'numeric', 'max:999999999'],      
    //     'venta' =>  ['required', 'min:1', 'numeric', 'max:999999999'], 
    // ];
    protected function rules()
    {
        return [
            'cantidad' =>  ['required', 'min:1', 'numeric', 'max:999999999'],
            'compra' =>  ['required', 'min:1', 'numeric', 'max:999999999'],
            'venta' =>  ['required', 'numeric', 'min:'. $this->compra, 'max:999999999'],            
        ];
    }

    public function mount(DetalleIngreso $detalleIngreso)
    {
        $this->detalleIngreso = $detalleIngreso;
        $this->cantidad = $this->detalleIngreso->cantidad;
        $this->compra = $this->detalleIngreso->precio_compra;
        $this->venta = $this->detalleIngreso->precio_venta;
    }
    public function updatedCantidad()
    {
        $this->validate();
        $this->detalleIngreso->cantidad = $this->cantidad;
        $this->detalleIngreso->subtotal = $this->detalleIngreso->cantidad * $this->detalleIngreso->precio_compra;
        $this->detalleIngreso->save();
        $this->emitTo('admin.ingresos.create-ingresos', 'render');
    }
    public function updatedCompra()
    {
        $this->validate();
        $this->detalleIngreso->precio_compra = $this->compra;
        $this->detalleIngreso->subtotal = $this->detalleIngreso->cantidad * $this->detalleIngreso->precio_compra;
        $this->detalleIngreso->save();
        $this->emitTo('admin.ingresos.create-ingresos', 'render');
    }
    public function updatedVenta()
    {
        $this->validate();
        $this->detalleIngreso->precio_venta = $this->venta;        
        $this->detalleIngreso->save();
        $this->emitTo('admin.ingresos.create-ingresos', 'render');
    }
    public function update()
    {        
        $this->validate();
        $this->detalleIngreso->cantidad = $this->cantidad;
        $this->detalleIngreso->precio_compra = $this->compra;
        $this->detalleIngreso->precio_venta = $this->venta;
        $this->detalleIngreso->subtotal = $this->detalleIngreso->cantidad * $this->detalleIngreso->precio_compra;
        $this->detalleIngreso->save();
        $this->emitTo('admin.ingresos.create-ingresos', 'render');
        $this->emit('alert', 'Actualizado');
    }
    public function destroy()
    {        
        $this->detalleIngreso->delete();
        $this->emitTo('admin.ingresos.create-ingresos', 'render');        
    }

    public function render()
    {
        return view('livewire.admin.ingresos.update');
    }
}
