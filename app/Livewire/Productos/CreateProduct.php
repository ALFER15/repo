<?php

namespace App\Livewire\Productos;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Livewire\Component;

class CreateProduct extends Component
{
    // Control de visibilidad del modal
    public $pCreate = false;

    // Variables para el formulario
    public $name, $stock, $store_price, $public_price, $expiration, $assortment, $status;
    public $category_id, $supplier_id;

    // Datos para cargar en los selects
    public $categories, $suppliers;

    /**
     * Método mount para inicializar datos.
     */
    public function mount()
    {
        // Cargar categorías y proveedores desde la base de datos
        $this->categories = Category::all();
        $this->suppliers = Supplier::all();
    }

    /**
     * Método para renderizar la vista.
     */
    public function render()
    {
        // Cargar productos desde la base de datos
        $products = Product::with(['category', 'supplier'])->get();

        // Pasar datos a la vista
        return view('livewire.productos.create-product', [
            'products' => $products,
        ]);
    }

    /**
     * Método para guardar un producto.
     */
    public function enviar()
    {
        // Validar los datos antes de guardar
        $this->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'store_price' => 'required|numeric|min:0',
            'public_price' => 'required|numeric|min:0',
            'expiration' => 'required|date',
            'assortment' => 'required|date',
            'status' => 'required|in:active,disable',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
        ]);

        // Crear un nuevo producto
        Product::create([
            'name' => $this->name,
            'stock' => $this->stock,
            'store_price' => $this->store_price,
            'public_price' => $this->public_price,
            'expiration' => $this->expiration,
            'assortment' => $this->assortment,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'supplier_id' => $this->supplier_id,
        ]);

        // Limpiar los campos después de guardar
        $this->resetForm();

        // Cerrar el modal
        $this->pCreate = false;

        // Emitir evento para recargar la lista de productos (opcional)
        $this->emit('productCreated');
    }

    /**
     * Método para limpiar el formulario.
     */
    public function resetForm()
    {
        $this->reset([
            'name', 'stock', 'store_price', 'public_price',
            'expiration', 'assortment', 'status', 'category_id', 'supplier_id'
        ]);
    }
}
