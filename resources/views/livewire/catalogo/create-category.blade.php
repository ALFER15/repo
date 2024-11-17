<div>
    @if ($mCreate)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
        <div class="py-12">
            
            <form wire:submit='enviar'>
                <div class="mb-4 text-center font-bold text-lg"><span>Crear nueva categoría</span></div>
                <div class="mb-4">
                    <x-label for="name" value="Nombre de la Categoria" />
                    <x-input type="text" wire:model='name' class="w-full mt-2" placeholder="Nombre de la Categoría" />
                </div>
                <div class="mb-4">
                    <x-label for="description" value="Descripción de la categoría" />
                    <x-input type="text" wire:model='description' class="w-full mt-2" placeholder="Descripción de la Categoría" /><br>
                </div>
                <x-button class="mt-2">Guardar</x-button>
                <x-border-button class="border-red-500 text-red-500 hover:bg-red-500 mt-2" wire:click='formCancel'>Cancelar</x-border-button>
            </form>
        </div>
    </div>
    @endif

    <div class="m-4">
        <div class="flex justify-end items-center space-x-4">
            <x-input name="search-category" placeholder="Buscar categoría" wire:model.live="searchCat" />
            <x-button wire:click="$set('mCreate', true)">Agregar categoría</x-button>
        </div>
    </div>

    {{--inicio--}}
    <table class="min-w-full table-fixed border-collapse border border-gray-300 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Descripción</th>
                <th scope="col" class="px-6 py-3">Fecha de Creación</th>
                <th scope="col" class="px-6 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr class="bg-white border-b dark:bg-gray-800" wire:key="{{ $category->id }}">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-200">
                    {{ $category->id }}
                </th>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-200">{{ $category->name }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-200">{{ $category->description }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-gray-200">{{ $category->created_at }}</td>
                <td class="px-6 py-4 flex justify-center items-center space-x-2">
                    <x-border-button wire:click='editar({{ $category->id }})'>Editar</x-border-button>
                    <x-danger-button wire:click='delete({{ $category->id }})'>Eliminar</x-danger-button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="m-2">
        {{$categories->links()}}
    </div>
    {{--fin--}}

    @if ($mEdit)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0 flex justify-center items-center z-50">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto">
            <form wire:submit='update'>
                <div class="mb-4 text-center font-bold text-lg"><span>Editar categoría</span></div>
                <div class="mb-4">
                    <x-label for="name" value="Nombre de la categoría" />
                    <x-input type="text" wire:model='categoryEdit.name' class="w-full mt-2" placeholder="Nombre de la Categoría" />
                </div>
                <div class="mb-4">
                    <x-label for="description" value="Descripción de la categoría" />
                    <x-input type="text" wire:model='categoryEdit.description' class="w-full mt-2" placeholder="Descripción de la Categoría" /><br>
                </div>
                <div class="flex space-x-4 mt-4">
                    <x-danger-button wire:click="$set('mEdit', false)">Cancelar</x-danger-button>
                    <x-button>Actualizar</x-button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
