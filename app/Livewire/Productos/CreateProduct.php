<?php

namespace App\Livewire\Productos;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class CreateProduct extends Component
{
    use WithPagination;

    public $pCreate = false; // Modal de creación oculto
    public $pEdit = false;   // Modal de edición oculto
    public $editId = null;   // ID del producto a editar

    public $category_id = "";
    public $supplier_id = "";

    public $name, $stock, $store_price, $public_price, $expiration, $assortment, $status = "";
    public $search = ""; // Propiedad para la búsqueda

    public $categories, $suppliers;

    public function mount()
    {
        // Cargar categorías y proveedores al inicializar el componente
        $this->categories = Category::all();
        $this->suppliers = Supplier::all();
    }

    public function render()
    {
        // Filtrar productos según la búsqueda
        $products = Product::with('category', 'supplier')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('status', 'like', '%' . $this->search . '%')
                      ->orWhere('stock', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc') // Ordenar por ID de manera descendente
            ->paginate(10);

        return view('livewire.productos.create-product', compact('products'));
    }

    public function abrirModalCrear()
    {
        $this->resetForm(); // Limpia el formulario antes de abrirlo
        $this->pCreate = true;
    }

    public function cerrarModalCrear()
    {
        $this->resetForm(); // Limpia el formulario al cerrarlo
        $this->pCreate = false;
    }

    public function resetForm()
    {
        // Limpia las propiedades del formulario de creación
        $this->reset(['name', 'stock', 'store_price', 'public_price', 'expiration', 'assortment', 'status', 'category_id', 'supplier_id']);
    }

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
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'status' => 'required|in:active,disable',
        ]);

        // Crear el producto
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

        session()->flash('success', 'Producto creado exitosamente.');

        // Cierra el modal después de crear y limpia el formulario
        $this->cerrarModalCrear();
    }

    public function editar($id)
    {
        $product = Product::find($id);

        if ($product) {
            $this->editId = $id;
            $this->name = $product->name;
            $this->stock = $product->stock;
            $this->store_price = $product->store_price;
            $this->public_price = $product->public_price;
            $this->expiration = $product->expiration;
            $this->assortment = $product->assortment;
            $this->status = $product->status;
            $this->category_id = $product->category_id;
            $this->supplier_id = $product->supplier_id;
            $this->pEdit = true; // Muestra el modal de edición
        }
    }

    public function update()
    {
        $product = Product::find($this->editId);

        if ($product) {
            // Actualizar los datos del producto
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

            session()->flash('success', 'Producto actualizado exitosamente.');

            // Resetea las propiedades y cierra el modal
            $this->reset(['editId', 'name', 'stock', 'store_price', 'public_price', 'expiration', 'assortment', 'status', 'pEdit', 'category_id', 'supplier_id']);
        }
    }

    public function eliminar($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            session()->flash('success', 'Producto eliminado exitosamente.');
        } else {
            session()->flash('error', 'Producto no encontrado.');
        }
    }
}
