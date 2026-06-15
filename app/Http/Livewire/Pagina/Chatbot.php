<?php

namespace App\Http\Livewire\Pagina;

use Livewire\Component;

class Chatbot extends Component
{
    public function chatbot(){
        $this->emit('chatbot', 'chatbot');
    }

    public function render()
    {
        return view('livewire.pagina.chatbot');
    }
}
