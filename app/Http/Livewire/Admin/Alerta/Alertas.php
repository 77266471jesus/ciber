<?php

namespace App\Http\Livewire\Admin\Alerta;

use App\Models\Alerta;
use Livewire\Component;

class Alertas extends Component
{
    public $critico, $alto, $moderado;
    public $alertas;

    protected function rules()
    {
        return [
            'critico' =>  ['required', 'min:1', 'numeric', 'max:' . $this->alto],
            'alto' =>  ['required', 'min:1', 'numeric', 'max:' . $this->moderado],
            'moderado' =>  ['required', 'min:1', 'numeric', 'max:999999999'],
        ];
    }

    public function mount()
    {
        $this->alertas = Alerta::all();
        foreach ($this->alertas as $alerta) {
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
    }
    public function save()
    {
        $this->validate();
        foreach ($this->alertas as $alerta) {
            if ($alerta->alerta == 'Critico') {
                $alerta->valor =  $this->critico;
            }
            if ($alerta->alerta == 'Alto') {
                $alerta->valor =  $this->alto;
            }
            if ($alerta->alerta == 'Moderado') {
                $alerta->valor =  $this->moderado;
            }
            $alerta->save();
        }
        session()->flash('message', 'Guardado...');
        $this->emitTo('admin.configuracion.notificacion', 'render');
    }

    public function render()
    {
        return view('livewire.admin.alerta.alertas');
    }
}
