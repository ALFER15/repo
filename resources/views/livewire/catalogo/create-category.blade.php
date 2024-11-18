<div>
    @if ($mCreate)
    <div class="bg-gray-800 bg-opacity-50 fixed inset-0 flex justify-center items-center z-50">
        <div class="bg-white rounded-lg shadow-lg p-8 max-w-md w-full">
            <form wire:submit='enviar'>
                <div class="mb-6 text-center font-bold text-xl text-gray-700">Crear nueva categoría</div>
                
                <!-- Campo de nombre -->
                <div class="mb-4">
                    <x-label for="name" value="Nombre de la Categoria" class="text-gray-600" />
                    <x-input type="text" wire:model='name' class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nombre de la Categoría" />
                </div>
                
                <!-- Campo de descripción -->
                <div class="mb-4">
                    <x-label for="description" value="Descripción de la categoría" class="text-gray-600" />
                    <x-input type="text" wire:model='description' class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Descripción de la Categoría" /><br>
                </div>

                <!-- Botones -->
                <div class="flex space-x-4 mt-4">
                    <x-button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg transition duration-200">Guardar</x-button>
                    <x-border-button class="w-full border-red-500 text-red-500 hover:bg-red-500 py-2 rounded-lg transition duration-200" wire:click='formCancel'>Cancelar</x-border-button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div class="m-4">
        <div class="flex justify-end items-center space-x-4">
            <x-input name="search-category" placeholder="Buscar categoría" wire:model.live="searchCat" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <x-button wire:click="$set('mCreate', true)" class="bg-green-500 hover:bg-green-600 text-white py-2 px-6 rounded-lg transition duration-200">Agregar categoría</x-button>
        </div>
    </div>

    {{-- Tabla de categorías --}}
    <table class="min-w-full table-fixed border-collapse border border-gray-300 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-4">
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
                    <x-border-button wire:click='editar({{ $category->id }})' class="py-2 px-4 border border-blue-500 text-blue-500 hover:bg-blue-500 hover:text-white rounded-lg transition duration-200">Editar</x-border-button>
                    <x-danger-button wire:click='delete({{ $category->id }})' class="py-2 px-4 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition duration-200">Eliminar</x-danger-button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="m-2">
        {{$categories->links()}}
    </div>

    {{-- Modal de edición de categoría --}}
    @if ($mEdit)
    <div class="bg-gray-800 bg-opacity-50 fixed inset-0 flex justify-center items-center z-50">
        <div class="bg-white shadow-lg rounded-lg p-6 max-w-md mx-auto">
            <form wire:submit='update'>
                <div class="mb-4 text-center font-bold text-lg text-gray-700"><span>Editar categoría</span></div>

                <!-- Campo de nombre -->
                <div class="mb-4">
                    <x-label for="name" value="Nombre de la categoría" class="text-gray-600" />
                    <x-input type="text" wire:model='categoryEdit.name' class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nombre de la Categoría" />
                </div>

                <!-- Campo de descripción -->
                <div class="mb-4">
                    <x-label for="description" value="Descripción de la categoría" class="text-gray-600" />
                    <x-input type="text" wire:model='categoryEdit.description' class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Descripción de la Categoría" /><br>
                </div>

                <!-- Botones -->
                <div class="flex space-x-4 mt-4">
                    <x-danger-button wire:click="$set('mEdit', false)" class="py-2 px-4 border border-red-500 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition duration-200">Cancelar</x-danger-button>
                    <x-button class="py-2 px-4 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition duration-200">Actualizar</x-button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
