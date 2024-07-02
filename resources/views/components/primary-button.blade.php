<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2 border border-transparent rounded-lg shadow-lg text-sm font-semibold text-white bg-gradient-to-r from-[#E57E5B] to-[#D86F4A] hover:from-[#D86F4A] hover:to-[#C95E38] focus:outline-none focus:ring-2 focus:ring-[#E57E5B] focus:ring-offset-2 transition duration-300 ease-in-out']) }}>
    <span class="mr-2"> {{ $slot }} </span>
</button>
