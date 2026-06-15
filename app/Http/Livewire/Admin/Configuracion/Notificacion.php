<?php

namespace App\Http\Livewire\Admin\Configuracion;

use App\Models\Alerta;
use App\Models\Producto;
use Livewire\Component;

class Notificacion extends Component
{
    protected $listeners = ['render'];
    
    public $critico, $alto, $moderado;

    public function render()
    {
        $alertas = Alerta::all();
        foreach($alertas as $alerta){
            if ($alerta->alerta == 'Critico') {
                $this->critico = $alerta->valor;
            }
            if ($alerta->alerta == 'Alto') {
                $this->alto = $alerta->valor;
            }
            if ($alerta->alerta == 'Moderado') {
                $this->moderado = $alerta->valor;
            }
        }

        $productos = Producto::where('stock', '<=', $this->moderado)
        ->orderBy('stock', 'asc')
        ->get();

        return view('livewire.admin.configuracion.notificacion', compact('productos'));
    }
}
