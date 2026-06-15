<?php

namespace App\Http\Livewire\Pagina;

use App\Models\DetalleCotizacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Carrito extends Component
{
    public $date, $user_id;
    protected $listeners = ['render'];

    public function mount()
    {
        $this->fecha = Carbon::now();
        $this->user_id = Auth::user()->id;
    }
    public function render()
    {
        $detalleCotizacions = DetalleCotizacion::where('cotizacion_id', null)
        ->where('user_id', $this->user_id)->get();

        $total = DetalleCotizacion::where('cotizacion_id', null)
        ->where('user_id', $this->user_id)->sum('subtotal');

        return view('livewire.pagina.carrito', compact('detalleCotizacions', 'total'));
    }
}
