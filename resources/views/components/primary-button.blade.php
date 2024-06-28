<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-4 py-1 border border-transparent rounded-full shadow-sm text-xs font-medium text-white bg-gradient-to-r from-orange-400 to-orange-600 hover:from-orange-500 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-300 ease-in-out']) }}>
    <span class="mr-2"> {{ $slot }} </span>
</button>

