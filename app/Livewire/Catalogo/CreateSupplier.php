<?php

namespace App\Livewire\Catalogo;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class CreateSupplier extends Component
{
    use WithPagination;

    public $name, $phone, $address, $rfc, $email, $manager_name;
    public $idEditable;

    public $mEdit = false;
    public $mCreate = false;

    public $searchSup = '';
    public $supplierEdit = [
        'id' => '',
        'name' => '',
        'phone' => '',
        'address' => '',
        'email' => '',
        'manager_name' => '',
        'rfc' => ''
    ];

    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->searchSup . '%')
            ->orWhere('rfc', 'like', '%' . $this->searchSup . '%')
            ->orWhere('phone', 'like', '%' . $this->searchSup . '%')
            ->orWhere('address','like', '%' . $this->searchSup . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.catalogo.create-supplier', compact('suppliers'));
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
        $this->reset(['name', 'phone', 'address', 'rfc', 'email', 'manager_name', 'mCreate']);
    }
    
    public function editar($supplierID){
        $this->mEdit = true;
        $supplierEditable = Supplier::find($supplierID);
        $this->idEditable = $supplierEditable->id;
        $this->supplierEdit['name'] = $supplierEditable->name;
        $this->supplierEdit['phone'] = $supplierEditable->phone;
        $this->supplierEdit['address'] = $supplierEditable->address;
        $this->supplierEdit['rfc'] = $supplierEditable->rfc;
        $this->supplierEdit['email'] = $supplierEditable->email;
        $this->supplierEdit['manager_name'] = $supplierEditable->manager_name;
    }

    public function update() {
        $supplier = Supplier::find($this->idEditable);
        $supplier->update([
            'name' => $this->supplierEdit['name'],
            'phone' => $this->supplierEdit['phone'],
            'address' => $this->supplierEdit['address'],
            'rfc' => $this->supplierEdit['rfc'],
            'email' => $this->supplierEdit['email'],
            'manager_name' => $this->supplierEdit['manager_name'],
        ]);
        $this->reset([
            'supplierEdit',
            'idEditable',
            'mEdit'
        ]);
    }

    public function formCancel(){
        $this->reset([
            'mCreate',
            'name',
            'phone',
            'address',
            'rfc',
            'email',
            'manager_name'
        ]);
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'searchSup') {
            $this->resetPage();}
        }

    public function eliminar (Supplier $supplier){
        $supplier->delete();
    }
}
