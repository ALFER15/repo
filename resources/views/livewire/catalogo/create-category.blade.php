<div>
    @if ($mCreate)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
            <div class="py-12">
                <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white shadow rounded-lg p-6">
                        <form class="max-w-sm mx-auto" wire:submit='enviar'>
                            <div class="mb-4"><span>Crear nueva categoria:</span></div>
                            <div class="mb-4">
                                <x-label for="name" value="Nombre de la categoría" class="w-full" />
                                <x-input name="name" wire:model='name' class="w-full" />
                                <x-input-error for='name' />
                            </div>
                            <div class="mb-4">
                                <x-label for="description" value="Nombre de la descripción" class="w-full" />
                                <x-input name="description" wire:model='description' class="w-full" /><br>
                                <x-input-error for='description' />
                            </div>
                            <x-button class="mt-2">Guardar</x-button>
                            <x-border-button class="mt-2"
                                wire:click="set('mCreate', false)">Cancelar</x-border-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class=" m-4">
        <div class="m-4 flex justify-end">
            <x-input name="search-category" placeholder="Busqueda" wire:model.live='searchCat' />
            <x-button class="ml-4" wire:click='creaCategoryState'>
                AGREGAR CATEGORÍA
            </x-button>
        </div>
        <table
            class="min-w-full table-fixed border-collapse border border-gray-300 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descripción
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha Creación
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="bg-white dark:bg-gray-800" wire:key="{{ $category->id }}">
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $category->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $category->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $category->description }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $category->created_at }}
                        </td>
                        <td class="px-6 py-4 h-30 flex justify-center items-center space-x-2">
                            <x-border-button class="border border-green-600" wire:click='editar({{ $category->id }})'>
                                Editar
                            </x-border-button>
                            <x-danger-button wire:click='eliminar({{ $category }})'>
                                Eliminar
                            </x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{-- Contenido --}}
        </table>
        <div class="mt4">
            {{ $categories->links() }}
        </div>
    </div>

    @if ($mEdit)
        <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
            <div class="py-12">
                <div class="bg-white shadow rounded-lg p-6">
                    <form class="max-w-lg mx-auto" wire:submit='update'>
                        <div class="mb-4"><span>Editar categoria:</span></div>
                        <x-label class="w-full " for="name" value="Nombre de la categoría" />
                        <x-input class="w-full " name="name" wire:model='categoryEdit.name' />
                        <x-label class="w-full " for="description" value="Nombre de la descripción" />
                        <x-input class="w-full " name="description" wire:model='categoryEdit.description' /><br>
                        <x-danger-button class="mt-2" wire:click="set('mEdit', false)">Cancelar</x-danger-button>
                        <x-button class="mt-2">Actualizar</x-button>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
