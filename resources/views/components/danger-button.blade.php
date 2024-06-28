<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-full shadow-sm text-xs font-medium text-white bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-300 ease-in-out']) }}>
    <span class="mr-2"> {{ $slot }} </span>
</button>
