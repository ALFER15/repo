<div>
    <!-- Botón para abrir el formulario de creación -->
    <div class="flex justify-end mb-4">
        <x-button wire:click="abrirModalCrear">Crear Producto</x-button>
    </div>

    <!-- Barra de búsqueda -->
    <div class="mb-4 flex justify-end">
        <x-input name="search" placeholder="Buscar producto..." wire:model.live="search" class="w-full max-w-sm" />
    </div>

    <!-- Modal de Creación de Producto -->
    @if ($pCreate)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
                <form wire:submit.prevent="enviar">
                    <h2 class="text-lg font-bold text-gray-700 mb-4">Crear Producto</h2>
                    <div class="mb-4">
                        <x-label for="name" value="Nombre del Producto" />
                        <x-input name="name" wire:model="name" class="w-full mt-1" />
                    </div>
                    <div class="mb-4">
                        <x-label for="stock" value="Inventario" />
                        <x-input type="number" name="stock" wire:model="stock" class="w-full mt-1" />
                    </div>
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="store_price" value="Precio de Compra" />
                            <x-input type="number" name="store_price" wire:model="store_price" class="w-full mt-1" />
                        </div>
                        <div>
                            <x-label for="public_price" value="Precio de Venta" />
                            <x-input type="number" name="public_price" wire:model="public_price" class="w-full mt-1" />
                        </div>
                    </div>
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="expiration" value="Fecha de Caducidad" />
                            <x-input type="date" name="expiration" wire:model="expiration" class="w-full mt-1" />
                        </div>
                        <div>
                            <x-label for="assortment" value="Fecha de Surtido" />
                            <x-input type="date" name="assortment" wire:model="assortment" class="w-full mt-1" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-label for="category_id" value="Categoría" />
                        <select wire:model="category_id" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-label for="supplier_id" value="Proveedor" />
                        <select wire:model="supplier_id" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-label for="status" value="Estatus" />
                        <select wire:model="status" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                            <option value="" selected disabled>Seleccione una opción</option>
                            <option value="active">Activo</option>
                            <option value="disable">No disponible</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <x-border-button wire:click="cerrarModalCrear" class="bg-red-500 text-white px-4 py-2 rounded-md">Cancelar</x-border-button>
                        <x-button class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</x-button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Modal de Edición de Producto -->
    @if ($pEdit)
        <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-lg">
                <form wire:submit.prevent="update">
                    <h2 class="text-lg font-bold text-gray-700 mb-4">Editar Producto</h2>
                    <!-- Campos del formulario de edición -->
                    <div class="mb-4">
                        <x-label for="name" value="Nombre del Producto" />
                        <x-input name="name" wire:model="name" class="w-full mt-1" />
                    </div>
                    <div class="mb-4">
                        <x-label for="stock" value="Inventario" />
                        <x-input type="number" name="stock" wire:model="stock" class="w-full mt-1" />
                    </div>
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="store_price" value="Precio de Compra" />
                            <x-input type="number" name="store_price" wire:model="store_price" class="w-full mt-1" />
                        </div>
                        <div>
                            <x-label for="public_price" value="Precio de Venta" />
                            <x-input type="number" name="public_price" wire:model="public_price" class="w-full mt-1" />
                        </div>
                    </div>
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="expiration" value="Fecha de Caducidad" />
                            <x-input type="date" name="expiration" wire:model="expiration" class="w-full mt-1" />
                        </div>
                        <div>
                            <x-label for="assortment" value="Fecha de Surtido" />
                            <x-input type="date" name="assortment" wire:model="assortment" class="w-full mt-1" />
                        </div>
                    </div>
                    <div class="mb-4">
                        <x-label for="category_id" value="Categoría" />
                        <select wire:model="category_id" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-label for="supplier_id" value="Proveedor" />
                        <select wire:model="supplier_id" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-label for="status" value="Estatus" />
                        <select wire:model="status" class="w-full border-gray-300 rounded-md shadow-sm mt-1">
                            <option value="" selected disabled>Seleccione una opción</option>
                            <option value="active">Activo</option>
                            <option value="disable">No disponible</option>
                        </select>
                    </div>
                    <div class="flex justify-between">
                        <x-border-button wire:click="$set('pEdit', false)" class="bg-red-500 text-white px-4 py-2 rounded-md">Cancelar</x-border-button>
                        <x-button class="bg-blue-500 text-white px-4 py-2 rounded-md">Actualizar</x-button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Tabla de Productos -->
    <div class="mt-8 rounded-lg bg-gray-800 p-4">
        <table class="w-full border-collapse text-left text-sm">
            <thead class="bg-gray-700 text-gray-300 uppercase">
                <tr>
                    <th class="border-b border-gray-600 px-4 py-2">ID</th>
                    <th class="border-b border-gray-600 px-4 py-2">Nombre</th>
                    <th class="border-b border-gray-600 px-4 py-2">Inventario</th>
                    <th class="border-b border-gray-600 px-4 py-2">Precio Compra</th>
                    <th class="border-b border-gray-600 px-4 py-2">Precio Venta</th>
                    <th class="border-b border-gray-600 px-4 py-2">Fecha Surtido</th>
                    <th class="border-b border-gray-600 px-4 py-2">Fecha Expiración</th>
                    <th class="border-b border-gray-600 px-4 py-2">Estatus</th>
                    <th class="border-b border-gray-600 px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-gray-800 text-gray-200">
                @forelse ($products as $product)
                    <tr class="hover:bg-gray-700">
                        <td class="px-4 py-2">{{ $product->id }}</td>
                        <td class="px-4 py-2">{{ $product->name }}</td>
                        <td class="px-4 py-2 text-center">{{ $product->stock }}</td>
                        <td class="px-4 py-2 text-center">${{ number_format($product->store_price, 2) }}</td>
                        <td class="px-4 py-2 text-center">${{ number_format($product->public_price, 2) }}</td>
                        <td class="px-4 py-2 text-center">{{ $product->assortment }}</td>
                        <td class="px-4 py-2 text-center">{{ $product->expiration }}</td>
                        <td class="px-4 py-2 text-center">{{ ucfirst($product->status) }}</td>
                        <td class="px-4 py-2 text-center flex space-x-2">
                            <x-button wire:click="editar({{ $product->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded-md">Editar</x-button>
                            <x-danger-button wire:click="eliminar({{ $product->id }})" class="bg-red-500 text-white px-2 py-1 rounded-md">Eliminar</x-danger-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="px-4 py-2 text-center text-gray-500">No hay productos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <!-- Paginación -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
