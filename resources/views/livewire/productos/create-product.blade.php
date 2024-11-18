<div>
    @if ($pCreate)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
            <div class="py-12">
                <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow rounded-lg p-6">
                        <form class="max-w-sm mx-auto" wire:submit='enviar'>
                            <div class="mb-4"><span>Crear producto:</span></div>
                            <div class="mb-4">
                                <x-label for="name" value="Nombre del Producto" class="w-full" />
                                <x-input name="name" wire:model='name' class="w-full" />
                            </div>
                            <div class="mb-4">
                                <x-label for="stock" value="Inventario" class="w-full" />
                                <x-input type="number" name="stock" wire:model='stock' class="w-full" />
                            </div>
                            <div class="mb-4">
                                <x-label for="store_price" value="Precio de compra" class="w-full" />
                                <x-input type="number" min="0" value="0" step="0.01" name="store_price" wire:model='store_price' class="w-full" /><br>
                                <x-label for="public_price" value="Precio de Venta" class="w-full" />
                                <x-input type="number" min="0" value="0" step="0.01"  name="public_price" wire:model='public_price' class="w-full" /><br>
                            </div>
                            <div class="mb-4">
                                <x-label for="expiration" value="Fecha de caducidad" class="w-full" />
                                <x-input type="date" name="expiration" wire:model='expiration' class="w-full" /><br>
                            </div>
                            <div class="mb-4">
                                <x-label for="assortment" value="Fecha de surtido" class="w-full" />
                                <x-input type="date" name="assortment" wire:model='assortment' class="w-full" /><br>
                            </div>
                            <div class="mb-4">
                                <x-label for="category" value="Categoría" class="w-full" />
                                <select wire:model='category_id' class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($categories as $category)
                                        <option wire:key='{{ $category->id }}' value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="mb-4">
                                <x-label for="supplier_id" value="Proveedor" class="w-full" />
                                <select wire:model='supplier_id' class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    @foreach ($suppliers as $supplier)
                                        <option wire:key='{{ $supplier->id }}' value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                <br>
                            </div>
                            <div class="mb-4">
                                <x-label for="status" value="Estatus" class="w-full" />
                                <select wire:model='status' class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                    <option value="" selected disabled>Seleccione una opción</option>
                                    <option value="active">Activo</option>
                                    <option value="disable">No disponible</option>
                                </select>
                                <br>
                            </div>
                            <x-button class="mt-2">Guardar</x-button>
                            <x-border-button class="mt-2"
                                wire:click="set('pCreate', false)">Cancelar</x-border-button>
                        </form>
                    </div>
                </div>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-4 py-2 text-center text-gray-500">No hay productos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $categories }}
    {{-- public $name, $stock, $store_price, $public_price, $expiration, $assortment, $status; --}}
</div>
