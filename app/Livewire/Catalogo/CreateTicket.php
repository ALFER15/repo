<?php

namespace App\Livewire\Catalogo;

use Livewire\Component;

class CreateTicket extends Component
{
    public function render()
    {
        // Mensaje de prueba para verificar que se está llamando al componente
        return view('livewire.catalogo.create-ticket')->with('message', 'Componente CreateTicket cargado correctamente.');
    }
}
