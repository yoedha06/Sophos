<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Dashboard' }} - Sophos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Navbar Styles */
        .nav-header {
            background-color: #1767c8;
            color: white;
        }

        .nav-header h1 {
            font-size: 1.75rem;
            font-weight: bold;
        }

        /* Sidebar Styles */
        .sidebar {
            background-color: #1F2937;
            color: #FFFFFF;
        }

        .sidebar a {
            color: #A3A3A3;
        }

        .sidebar a:hover {
            background-color: #3B82F6;
            color: white;
        }

        /* Sidebar Item */
        .sidebar .active {
            background-color: #3B82F6;
            color: white;
        }

        /* Content Styles */
        .content {
            margin-top: 4rem;
            margin-left: 16rem;
            padding: rem;
        }

        /* Responsive for Mobile */
        @media (max-width: 768px) {
            .content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
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
                    <div class="text-sm font-semibold">John Doe</div>
                    <div class="text-xs">Admin</div>
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

    <!-- Sidebar -->
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
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linejoin="round"
                            stroke-width="2"d="M22 2H2a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h9v2H8a1 1 0 0 0 0 2h8a1 1 0 0 0 0-2h-3v-2h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zm-1 2v8H3V4zM3 16v-2h18v2z" />
                    </svg>
                    <span class="ms-3 font-medium">Computer</span>
                </a>
            </li>
        </ul>
    </aside>

    {{ $slot }}

    @livewireScripts
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
