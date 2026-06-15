<?php

namespace App\Http\Livewire\Pagina;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\DetalleCotizacion;
use App\Models\Historial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Barryvdh\DomPDF\Facade\Pdf;

class VistaCarrito extends Component
{
    public $date, $user_id, $fecha;
    public $usuario, $cliente, $cliente_id, $user_email, $cotizacion_id;
    public $auxiliar, $proforma, $comprobante, $route;
    public $impuesto = 0;
    public $detalleCotizacions;

    protected $listeners = ['render'];

    public function mount()
    {
        $this->fecha = Carbon::now();
        $this->user_id = Auth::user()->id;
    }
    public function store()
    {
        $this->storecliente();
        $this->storeCotizacion();
        $this->storeDetalle();
        $this->emit('alert', 'Finalizado');
        $this->route = '/'.'proforma'.'/'. $this->cotizacion_id;   
        return redirect()->to('/historial-cotizacion');  
        // return redirect()->to($this->route);        
    }
    public function storecliente()
    {
        $this->usuario = User::find($this->user_id);
        $this->user_email = $this->usuario->email;
        $this->cliente = Cliente::where('email', $this->user_email)->first();
        $this->cliente_id = $this->cliente->id;
    }
    public function storecotizacion()
    {
        $this->proforma();
        Cotizacion::create([
            'comprobante' => $this->comprobante,
            'fecha' =>  $this->fecha,
            'total_cotizacion' =>  $this->total_cotizacion,
            'total' =>  $this->total_cotizacion,
            'impuesto' =>  $this->impuesto,
            'cliente_id' =>  $this->cliente_id,
            'user_id' =>  $this->user_id,
        ]);
    }
    public function storeDetalle()
    {
        $this->cotizacion_id = Cotizacion::latest('id')->select('id')->first()->id;
        foreach ($this->detalleCotizacions as $values) {
            $values->cotizacion_id = $this->cotizacion_id;
            $values->save();
        }
    }
    public function proforma()
    {
        $this->auxiliar = Cotizacion::select('comprobante')
            ->orderBy('id', 'desc')
            ->first();
        if ($this->auxiliar == null) {
            $this->proforma = 1;
        } else {
            $this->proforma = $this->auxiliar->comprobante + 1;
        }
        $this->comprobante = $this->proforma;
    }    

    public function render()
    {
        $this->detalleCotizacions = DetalleCotizacion::where('cotizacion_id', null)
            ->where('user_id', $this->user_id)->get();

        $this->total_cotizacion = DetalleCotizacion::where('cotizacion_id', null)
            ->where('user_id', $this->user_id)->sum('subtotal');

        return view('livewire.pagina.vista-carrito')
            ->extends('layouts.pagina');
    }
}
