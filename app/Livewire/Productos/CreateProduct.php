<?php

namespace App\Livewire\Productos;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;

class CreateProduct extends Component
{
    //TODO assortment = fecha en que se surtio el producto
    public $pCreate = true;
    public $category_id = "";
    public $supplier_id = "";

    public $name, $stock, $store_price, $public_price, $expiration, $assortment, $status = "";

    public $categories, $suppliers;

    public function mount(){
        $this->categories = Category::all();
        $this->suppliers  = Supplier::all();
    }

    public function render()
    {
        return view('livewire.productos.create-product');
    }

    //TODO falta el status
    public function enviar(){
        $product = new Product();
        $product->name = $this->name;
        $product->stock = $this->stock;
        $product->store_price = $this->store_price;
        $product->public_price = $this->public_price;
        $product->expiration = $this->expiration;
        $product->assortment = $this->assortment;
        $product->status = $this->status;
        $product->category_id = $this->category_id;
        $product->supplier_id = $this->supplier_id;
        $product->save();
        $this->reset(['name', 'stock', 'store_price', 'public_price', 'expiration', 'assortment', 'status', 'pCreate', 'category_id', 'supplier_id']);

    }
}
