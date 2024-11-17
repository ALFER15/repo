<div>
    <span>Agregar branch nuevo</span>
    
    {{-- Modal de creación --}}
    @if ($mCreate)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex justify-center items-center z-50">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto">
            <form class="max-w-sm mx-auto" wire:submit.prevent='enviar'>
                <x-label for="name" value="Nombre"/>
                <x-input name="name" wire:model='name'/>

                <x-label for="phone" value="Teléfono"/>
                <x-input name="phone" class="mb-2" wire:model='phone'/>

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
            <x-input name="search-branch" placeholder="Buscar branch" wire:model.live="searchBranch" />
            <x-button wire:click="$set('mCreate', true)">Agregar branch</x-button>
        </div>
    </div>

    {{-- Tabla de branches --}}
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">RFC</th>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Teléfono</th>
                <th scope="col" class="px-6 py-3">Dirección</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($branches as $branch)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $branch->id }}
                </th>
                <td class="px-6 py-4">{{ $branch->rfc }}</td>
                <td class="px-6 py-4">{{ $branch->name }}</td>
                <td class="px-6 py-4">{{ $branch->phone }}</td>
                <td class="px-6 py-4">{{ $branch->address }}</td>
                <td>
                    <x-button class="bg-green-600 dark:bg-green-600" wire:click='editar({{ $branch->id }})'>Editar</x-button>
                    <x-danger-button wire:click='eliminar({{ $branch->id }})'>Eliminar</x-danger-button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="m-2">
        {{ $branches->links() }}
    </div>

    {{-- Modal de edición --}}
    @if ($mEdit)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex justify-center items-center">
        <div class="bg-white shadow rounded-lg p-6">
            <form class="max-w-lg mx-auto" wire:submit.prevent='update'>
                <div class="mb-4"><span>Editar branch:</span></div>

                <x-label for="name" value="Nombre"/>
                <x-input name="name" wire:model='branchEdit.name'/>

                <x-label for="phone" value="Teléfono"/>
                <x-input name="phone" wire:model='branchEdit.phone'/>

                <x-label for="address" value="Dirección"/>
                <textarea id="address" name="address" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model='branchEdit.address'></textarea>

                <x-label for="rfc" value="RFC"/>
                <x-input name="rfc" wire:model='branchEdit.rfc'/>
                <br>
                <x-button class="mt-2">Actualizar</x-button>
                <x-danger-button class="mt-2" wire:click="$set('mEdit', false)">Cancelar</x-danger-button>
            </form>
        </div>
    </div>
    @endif
</div>
