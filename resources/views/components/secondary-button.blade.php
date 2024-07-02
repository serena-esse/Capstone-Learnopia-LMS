<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2  border-transparent rounded-lg shadow-lg text-sm font-semibold text-white bg-[#B0D4A7] hover:bg-[#9ebe96] focus:outline-none focus:ring-2 focus:ring-[#B0D4A7] focus:ring-offset-2 transition duration-300 ease-in-out']) }}>
    <span class="mr-2"> {{ $slot }} </span>
</button>
