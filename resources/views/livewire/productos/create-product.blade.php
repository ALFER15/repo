<div class="bg-gray-900 min-h-screen flex flex-col items-center py-6">
    @if ($pCreate)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex items-center justify-center">
            <div class="bg-gray-800 text-gray-100 shadow-lg rounded-lg p-6 w-full max-w-2xl">
                <form wire:submit='enviar'>
                    <div class="mb-4 text-center font-bold text-lg text-gray-100">Crear Producto</div>
                    <div class="mb-4">
                        <x-label for="name" value="Nombre del Producto" class="text-gray-300" />
                        <x-input name="name" wire:model='name' class="w-full mt-1 bg-gray-700 border-gray-600 text-gray-100" />
                    </div>
                    <div class="mb-4">
                        <x-label for="stock" value="Inventario" class="text-gray-300" />
                        <x-input type="number" name="stock" wire:model='stock' class="w-full mt-1 bg-gray-700 border-gray-600 text-gray-100" />
                    </div>
                    <div class="mb-4">
                        <x-label for="store_price" value="Precio de compra" class="text-gray-300" />
                        <x-input type="number" min="0" value="0" step="0.01" name="store_price" wire:model='store_price' class="w-full mt-1 bg-gray-700 border-gray-600 text-gray-100" />
                    </div>
                    <div class="mb-4">
                        <x-label for="public_price" value="Precio de Venta" class="text-gray-300" />
                        <x-input type="number" min="0" value="0" step="0.01" name="public_price" wire:model='public_price' class="w-full mt-1 bg-gray-700 border-gray-600 text-gray-100" />
                    </div>
                    <div class="mb-4">
                        <x-label for="expiration" value="Fecha de caducidad" class="text-gray-300" />
                        <x-input type="date" name="expiration" wire:model='expiration' class="w-full mt-1 bg-gray-700 border-gray-600 text-gray-100" />
                    </div>
                    <div class="mb-4">
                        <x-label for="assortment" value="Fecha de surtido" class="text-gray-300" />
                        <x-input type="date" name="assortment" wire:model='assortment' class="w-full mt-1 bg-gray-700 border-gray-600 text-gray-100" />
                    </div>
                    <div class="mb-4">
                        <x-label for="category" value="Categoría" class="text-gray-300" />
                        <select wire:model='category_id' class="w-full mt-1 bg-gray-700 border-gray-600 text-gray-100 rounded-md shadow-sm">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($categories as $category)
                                <option wire:key='{{ $category->id }}' value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-label for="supplier" value="Proveedor" class="text-gray-300" />
                        <select wire:model='supplier_id' class="w-full mt-1 bg-gray-700 border-gray-600 text-gray-100 rounded-md shadow-sm">
                            <option value="" selected disabled>Seleccione una opción</option>
                            @foreach ($suppliers as $supplier)
                                <option wire:key='{{ $supplier->id }}' value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <x-label for="status" value="Estatus" class="text-gray-300" />
                        <select wire:model='status' class="w-full mt-1 bg-gray-700 border-gray-600 text-gray-100 rounded-md shadow-sm">
                            <option value="" selected disabled>Seleccione una opción</option>
                            <option value="active">Activo</option>
                            <option value="disable">No disponible</option>
                        </select>
                    </div>
                    <div class="flex justify-between mt-4">
                        <x-border-button wire:click="set('pCreate', false)" class="bg-red-500 text-white px-4 py-2 rounded-md">Cancelar</x-border-button>
                        <x-button class="bg-blue-500 text-white px-4 py-2 rounded-md">Guardar</x-button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Mostrar lista de productos -->
    <div class="mt-8 mx-auto w-full max-w-6xl">
        <h2 class="text-lg font-semibold mb-4 text-center text-gray-100">Lista de Productos</h2>
        <div class="overflow-hidden shadow rounded-lg">
            <table class="w-full text-sm border border-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase">Nombre</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase">Inventario</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase">Precio Compra</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase">Precio Venta</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-300 uppercase">Estatus</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-700">
                            <td class="px-4 py-2 text-gray-300">{{ $product->name }}</td>
                            <td class="px-4 py-2 text-gray-300 text-center">{{ $product->stock }}</td>
                            <td class="px-4 py-2 text-gray-300 text-center">${{ number_format($product->store_price, 2) }}</td>
                            <td class="px-4 py-2 text-gray-300 text-center">${{ number_format($product->public_price, 2) }}</td>
                            <td class="px-4 py-2 text-gray-300 text-center capitalize">{{ $product->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-300">No hay productos disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
