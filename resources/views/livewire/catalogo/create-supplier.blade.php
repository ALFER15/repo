<div>
    <span>Agregar supplier nuevo</span>
    
    {{-- Modal de creación --}}
    @if ($mCreate)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex justify-center items-center z-50">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto">
            <form class="max-w-sm mx-auto" wire:submit.prevent='enviar'>
                <x-label for="name" value="Nombre"/>
                <x-input name="name" wire:model='name'/>

                <x-label for="phone" value="Teléfono"/>
                <x-input name="phone" class="mb-2" wire:model='phone'/>

                <x-label for="email" value="Email"/>
                <x-input name="email" wire:model='email'/>

                <x-label for="manager_name" value="Nombre del representante"/>
                <x-input name="manager_name" wire:model='manager_name'/>

                <x-label for="address" value="Dirección"/>
                <textarea id="address" name="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model='address' placeholder="Dirección"></textarea>

                <x-label for="rfc" value="RFC"/>
                <x-input name="rfc" wire:model='rfc'/><br>

                <x-button class="mt-2">Guardar</x-button>
                <x-border-button class="border-red-500 text-red-500 hover:bg-red-500 mt-2" wire:click='formCancel'>Cancelar</x-border-button>
            </form>    
        </div>
    </div>
    @endif

    {{-- Campo de búsqueda y botón de agregar --}}
    <div class="m-4">
        <div class="flex justify-end items-center space-x-4">
            <x-input name="search-supplier" placeholder="Buscar supplier" wire:model.live="searchSup" />
            <x-button wire:click="$set('mCreate', true)">Agregar proveedor</x-button>
        </div>
    </div>

    {{-- Tabla de suppliers --}}
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">RFC</th>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Teléfono</th>
                <th scope="col" class="px-6 py-3">Email</th>
                <th scope="col" class="px-6 py-3">Representante</th>
                <th scope="col" class="px-6 py-3">Dirección</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suppliers as $supplier)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $supplier->id }}
                </th>
                <td class="px-6 py-4">{{ $supplier->rfc }}</td>
                <td class="px-6 py-4">{{ $supplier->name }}</td>
                <td class="px-6 py-4">{{ $supplier->phone }}</td>
                <td class="px-6 py-4">{{ $supplier->email }}</td>
                <td class="px-6 py-4">{{ $supplier->manager_name }}</td>
                <td class="px-6 py-4">{{ $supplier->address }}</td>
                <td>
                    <x-button class="bg-green-600 dark:bg-green-600" wire:click='editar({{ $supplier->id }})'>Editar</x-button>
                    <x-danger-button wire:click='eliminar({{ $supplier->id }})'>Eliminar</x-danger-button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="m-2">
        {{ $suppliers->links() }}
    </div>

    {{-- Modal de edición --}}
    @if ($mEdit)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex justify-center items-center">
        <div class="bg-white shadow rounded-lg p-6">
            <form class="max-w-lg mx-auto" wire:submit.prevent='update'>
                <div class="mb-4"><span>Editar supplier:</span></div>

                <x-label for="name" value="Nombre"/>
                <x-input name="name" wire:model='supplierEdit.name'/>

                <x-label for="phone" value="Teléfono"/>
                <x-input name="phone" wire:model='supplierEdit.phone'/>

                <x-label for="email" value="Email"/>
                <x-input name="email" wire:model='supplierEdit.email'/>

                <x-label for="manager_name" value="Representante"/>
                <x-input name="manager_name" wire:model='supplierEdit.manager_name'/>

                <x-label for="address" value="Dirección"/>
                <textarea id="address" name="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model='supplierEdit.address'></textarea>

                <x-label for="rfc" value="RFC"/>
                <x-input name="rfc" wire:model='supplierEdit.rfc'/>
                <br>
                <x-button class="mt-2">Actualizar</x-button>
                <x-danger-button class="mt-2" wire:click="$set('mEdit', false)">Cancelar</x-danger-button>
            </form>
        </div>
    </div>
    @endif
</div>
