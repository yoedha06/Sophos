<div>
    <nav class="nav-header fixed top-0 w-full z-50 flex items-center justify-between p-2 shadow-md">
        <div class="flex items-center">
            <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" class="p-2 text-white sm:hidden">
                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
            <a wire:navigate href="/" class="text-white ms-4">
                <h1>Sophos</h1>
            </a>
        </div>
        <!-- User Profile Dropdown -->
        <div x-data="{ open: false }" @click.outside="open = false" class="relative">
            <button @click="open = !open" class="flex items-center text-white focus:outline-none">
                <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                    alt="Profile Picture">
                <div class="ms-3 text-left">
                    <div class="text-sm font-semibold">CIGS</div>
                    <div class="text-xs">SuperAdmin</div>
                </div>
            </button>
            <div x-show="open" style="display:none" class="absolute right-0 mt-2 w-48 bg-white rounded shadow-md py-2"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95">
                <a wire:navigate href="/admin"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                <a wire:navigate href="/profile/admin"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a wire:navigate href="/setting"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                <a x-on:click="openModal = true" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Sign
                    Out</a>
            </div>
        </div>
    </nav>
    
    <aside id="logo-sidebar"
        class="sidebar fixed top-0 left-0 w-64 h-screen pt-14 transition-transform -translate-x-full sm:translate-x-0 shadow-lg">
        <ul class="space-y-1">
            <li>
                <h2 class="text-2xl mx-3 py-2 text-white font-bold">Endpoint</h2>
            </li>
            <hr>
        </ul>
        <ul class="space-y-4 mx-auto">
            <li>
                <a wire:navigate href="/"
                    class="flex items-center p-4 text-white hover:bg-blue-500 active:bg-blue-700">
                    <i class="fa-solid fa-display"></i>
                    <span class="ms-3 font-medium">Computer</span>
                </a>
            </li>
        </ul>
    </aside>
</div>