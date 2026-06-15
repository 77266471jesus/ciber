<?php

namespace App\Http\Livewire\Pagina;

use App\Models\DetalleCotizacion;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MostrarProducto extends Component
{
    public $slug, $product, $precio, $detalleCotizacions;
    public $exite = 1;
    public $date, $user_id;

    public function mount($producto)
    {
        $this->slug = $producto;
        $this->fecha = Carbon::now();        
        $this->product = new Producto();
    }

    public function productos(Producto $producto)
    {
        $this->user_id = Auth::user()->id;
        $this->product = $producto;
        $this->detalleCotizacions = DetalleCotizacion::where('cotizacion_id', null)
            ->where('user_id', $this->user_id)->get();
        foreach ($this->detalleCotizacions as $detalleCotizacion) {
            if ($detalleCotizacion->producto_id ==  $this->product->id) {
                $this->exite = 2;
            }
        }
        if ($this->exite == 2) {
            session()->flash('message', 'Producto exitente no agregado.');
        } else {
            $this->precio = $this->product->precio_venta + ($this->product->precio_venta * 0.13);
            DetalleCotizacion::create([
                'cantidad' =>  1,
                'precio_venta' => $this->precio,
                'descuento' =>  0,
                'subtotal' =>  $this->precio,
                'producto_id' =>  $this->product->id,
                'user_id' =>  $this->user_id,
            ]);
            session()->flash('message', 'Agregado al carrito.');
        }
        $this->emitTo('pagina.carrito', 'render');
    }


    public function render()
    {
        $producto = Producto::where('slug', $this->slug)
            ->first();

        return view('livewire.pagina.mostrar-producto', compact('producto'))
            ->extends('layouts.pagina');
    }
}
