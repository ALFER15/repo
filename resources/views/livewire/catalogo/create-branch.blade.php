<div>
    <span>Agregar branch nuevo:</span>
    <div class="ml-2 mr-4 mb-4 mt-4">
        <form class="max-w-sm mx-auto" wire:submit='enviar'>
            <x-label for="name" value="Nombre" />
            <x-input name="name" wire:model='name'/>

            <x-label for="phone" value="Telefono" />
            <x-input name="phone" class="mb-2" wire:model='phone'/>

            <textarea id="address" name="address" rows="4" wire:model='address'
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Dirección"></textarea>
            
                <x-label for="rfc" value="RFC" />
                <x-input name="rfc" wire:model='rfc'/><br>
            
            <x-button class="mt-2">Guardar</x-button>
        </form>
    </div>

    <div class="mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        ID
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Telefono
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Direccion
                    </th>
                    <th scope="col" class="px-6 py-3">
                        RFC
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                    
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $branch->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $branch->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $branch->phone }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $branch->address }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $branch->rfc }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{-- Contenido --}}
        </table>
    </div>
</div>
