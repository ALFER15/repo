<button {{ $attributes->merge([ 'type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 border border-green-600 text-green-600 bg-white hover:bg-green-600 hover:text-white rounded-md font-semibold text-xs  dark:text-gray-800 uppercase tracking-widest  dark:hover:bg-white focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
