<?php

namespace App\Livewire\Catalogo;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CreateCategory extends Component
{    
    use WithPagination;

    public $name;
    public $description;
    
    public $mEdit = false;
    public $mCreate = false;

    public $searchCat = '';

    public $idEditable;
    public $categoryEdit = [
        'id' => '',
        'name' => '',
        'description'=>''];

    public function mount (){
       /* $this -> name = $categories->name;
        $this -> description = $categories->description;
        //dd($cat); //SIRVE PARA DEBUGEAR LA INFORMACIÓN DE LA VARIABLE PERO NO GUARDA LA INFORMACIÓN, FUNCIONA COMO EL CONSOLE LOG DE JS*/
        //$this -> categories = Category::all();

    }//EJECUTA ALGUNAS COSAS ANTES DE RENDERIZAR
    
    public function render() 
    {
        //$this -> categories = Category::all();
        $categories = Category::where('name', 'like', '%'.$this->searchCat.'%')->
        orwhere('description', 'like', '%'.$this->searchCat.'%')
        ->orderBy('id','desc')->paginate(5);
        return view('livewire.catalogo.create-category', compact('categories'));
    }//RENDERIZA LA VISTA COMPLETA PARA PODER REDIBUJAR LOS COMPONENTES DE LA PÁGINA

    public function enviar(){
       /* $cat = Category::find($this->title);
        $this -> name = $cat->name;
        $this -> description = $cat->description;*/
        $category = new Category();
        $category->name = $this->name;
        $category->description = $this->description;
        $category->save();
        $this -> reset(['name', 'description', 'mCreate']);
    }
    public function editar($categoryID){
        $this->mEdit = true;
        $categoryEditable = Category::find($categoryID);
        $this->idEditable = $categoryEditable->id;
        $this->categoryEdit['name'] = $categoryEditable->name;
        $this->categoryEdit['description'] = $categoryEditable->description;}

        public function update(){
            $category=Category::find($this->idEditable);
            $category->update([
                'name'=> $this->categoryEdit['name'],
                'description'=> $this->categoryEdit['description'],

            ]);
            $this->reset([
                'categoryEdit',
                'idEditable',
                'mEdit'

            ]);

        }

        public function formCancel(){
            $this->reset([
                'mCreate',
                'name',
                'description'
            ]);
        }
        
        public function updated($propertyName)
        {
            if ($propertyName === 'searchCat') {
                $this->resetPage();}
            }
    
        public function delete(Category $category){
        $category -> delete();}
}