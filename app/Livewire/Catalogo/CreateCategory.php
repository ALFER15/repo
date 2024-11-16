<?php

namespace App\Livewire\Catalogo;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CreateCategory extends Component
{

    //Para que la paginación la controle livewire sin que se refresque la pagina, solo el componente
    use WithPagination;

    //Modelo del buscador
    public $searchCat;

    //public $categories;
    public $name;
    public $description;

    public $mCreate = false;
    public $mEdit = false;

    public $idEditable;
    public $categoryEdit = [
        'id' => '',
        'name' => '',
        'description' =>''
    ];

    // Resetea la página al cambiar el campo de búsqueda
    public function updated($propertyName)
    {
        // Verifica si el campo actualizado es 'search' y resetea la paginación
        if ($propertyName === 'searchCat') {
            $this->resetPage();
        }
    }

    public function mount (){
        //$this->categories = Category::all();
    }

    public function render()
    {
        //$this->categories = Category::all();
        //se agregan los datos de la categoria paginados
        $categories = Category::where('name', 'like', '%'.$this->searchCat.'%')
        ->orWhere('description', 'like', '%'.$this->searchCat.'%')
        ->orderBy('id', 'desc')->paginate(5);
        return view('livewire.catalogo.create-category', compact('categories'));
    }

    public function creaCategoryState(){
        $this->mCreate = true;
    }

    public function enviar(){
        $this->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->description = $this->description;
        $category->save();
        //Para que se resetee la paginación del componente cuando se agrega una nueva
        $this->resetPage();

        $this->reset(['name', 'description']);
    }

    public function editar($categoryID){
        $this->mEdit = true;
        $categoryEditable = Category::find($categoryID);
        $this->idEditable = $categoryEditable->id;
        $this->categoryEdit['name'] = $categoryEditable->name;
        $this->categoryEdit['description'] = $categoryEditable->description;

    }

    public function update(){
        $category = Category::find($this->idEditable);
        $category->update([
            'name' => $this->categoryEdit['name'],
            'description' => $this->categoryEdit['description'],
        ]);

        $this->reset([
            'categoryEdit',
            'idEditable',
            'mEdit'
        ]);

    }

    public function eliminar(Category $category){
        $category->delete();
    }
}
