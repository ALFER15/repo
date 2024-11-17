<?php

namespace App\Livewire\Catalogo;

use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;

class CreateBranch extends Component
{
    use WithPagination;

    public $name, $phone, $address, $rfc;
    public $idEditable;
    public $mEdit = false;
    public $mCreate = false;
    public $searchBranch = '';
    
    public $branchEdit = [
        'id' => '',
        'name' => '',
        'phone' => '',
        'address' => '',
        'rfc' => ''
    ];

    public function render()
    {
        $branches = Branch::where('name', 'like', '%' . $this->searchBranch . '%')
            ->orWhere('rfc', 'like', '%' . $this->searchBranch . '%')
            ->orWhere('phone', 'like', '%' . $this->searchBranch . '%')
            ->orWhere('address', 'like', '%' . $this->searchBranch . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.catalogo.create-branch', compact('branches'));
    }

    public function enviar()
    {
        $branch = new Branch();
        $branch->name = $this->name;
        $branch->phone = $this->phone;
        $branch->address = $this->address;
        $branch->rfc = $this->rfc;
        $branch->save();
        
        $this->reset(['name', 'phone', 'address', 'rfc', 'mCreate']);
    }

    public function editar($branchID)
    {
        $this->mEdit = true;
        $branchEditable = Branch::find($branchID);
        $this->idEditable = $branchEditable->id;
        $this->branchEdit['name'] = $branchEditable->name;
        $this->branchEdit['phone'] = $branchEditable->phone;
        $this->branchEdit['address'] = $branchEditable->address;
        $this->branchEdit['rfc'] = $branchEditable->rfc;
    }

    public function update()
    {
        $branch = Branch::find($this->idEditable);
        $branch->update([
            'name' => $this->branchEdit['name'],
            'phone' => $this->branchEdit['phone'],
            'address' => $this->branchEdit['address'],
            'rfc' => $this->branchEdit['rfc'],
        ]);

        $this->reset(['branchEdit', 'idEditable', 'mEdit']);
    }

    public function formCancel()
    {
        $this->reset(['mCreate', 'name', 'phone', 'address', 'rfc']);
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'searchBra') {
            $this->resetPage();}
        }

    public function eliminar(Branch $branch)
    {
        $branch->delete();
    }
}
