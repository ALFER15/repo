<?php

namespace App\Livewire\Catalogo;

use App\Models\Branch;
use Livewire\Component;

class CreateBranch extends Component
{
    public $name, $phone, $address, $rfc;
    public $branches;

    public function render()
    {
        $this->branches = Branch::all();
        return view('livewire.catalogo.create-branch');
    }

    public function enviar(){
        $branch = new Branch();
        $branch->name = $this->name;
        $branch->phone = $this->phone;
        $branch->address = $this->address;
        $branch->rfc = $this->rfc;
        $branch->save();
        $this->reset(['name', 'phone', 'address', 'rfc']);
    }
}
