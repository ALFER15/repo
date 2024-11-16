<?php

namespace App\Livewire\Catalogo;

use App\Models\Supplier;
use Livewire\Component;

class CreateSupplier extends Component
{
    public $name, $phone, $address, $rfc, $email, $manager_name;
    public $suppliers;

    public function render()
    {
        $this->suppliers = Supplier::all();
        return view('livewire.catalogo.create-supplier');
    }

    public function enviar(){
        $supplier = new Supplier();
        $supplier->name = $this->name;
        $supplier->phone = $this->phone;
        $supplier->address = $this->address;
        $supplier->email = $this->email;
        $supplier->manager_name = $this->manager_name;
        $supplier->rfc = $this->rfc;
        $supplier->save();
        $this->reset(['name', 'phone', 'address', 'rfc', 'email', 'manager_name']);
    }
}
