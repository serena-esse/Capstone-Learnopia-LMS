<nav id="mySidebar" class="fixed z-10 h-full shadow-md w-64 hidden md:flex flex-col">
    <!-- Sidebar Navigation Menu -->
    <div class="flex flex-col h-full">
        <!-- Close Button -->
        <div class="flex items-center justify-end p-4">
            <button class="closebtn text-black text-2xl" onclick="closeNav()">&times;</button>
        </div>

        <div class="flex items-center justify-center h-16">
            <!-- Logo -->
            <a href="{{ route('home') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="flex-grow mt-4">
            <div class="flex flex-col space-y-2">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="block px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-green-100">
                    <i class="fas fa-home mr-2"></i> {{ __('Home') }}
                </x-nav-link>
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block px-4 py-2 text-sm font-semibold text-black hover:bg-green-100">
                    <i class="fas fa-tachometer-alt mr-2"></i>{{ __('Dashboard') }}
                </x-nav-link>
                <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.*')" class="block px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-green-100">
                    <i class="fas fa-book mr-2"></i>{{ __('Courses') }}
                </x-nav-link>
                <x-nav-link :href="route('contact.form')" :active="request()->routeIs('contact.form')" class="block px-4 py-2 text-sm font-semibold text-gray-900 hover:bg-green-100">
                    <i class="fas fa-envelope mr-2"></i>{{ __('Contact Us') }}
                </x-nav-link>
            </div>
        </div>

        <!-- Settings Dropdown -->
        <div class="relative px-4 py-4 border-t border-orange-400">
            <x-dropdown align="right" width="full">
                <x-slot name="trigger">
                    <button class="inline-flex items-center w-full px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-white hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ml-auto">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a 1 1 0 111.414 1.414l-4 4a 1 1 0 01-1.414 0l-4-4a 1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <div class="absolute bottom-full mb-2 w-64 bg-white dark:bg-gray-800 shadow-lg rounded-md z-10">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <x-dropdown-link :href="route('courses.my')">
                            {{ __('My Courses') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>

<div id="main">
    <button class="openbtn" onclick="openNav()" id="openbtn">☰ Open Sidebar</button>
</div>

<script>
    function openNav() {
        document.getElementById("mySidebar").classList.remove('hidden');
        document.getElementById("main").style.marginLeft = "250px";
        document.getElementById("openbtn").style.display = 'none';
    }

    function closeNav() {
        document.getElementById("mySidebar").classList.add('hidden');
        document.getElementById("main").style.marginLeft = "0";
        document.getElementById("openbtn").style.display = 'block';
    }
</script>
