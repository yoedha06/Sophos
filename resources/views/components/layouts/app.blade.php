<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Dashboard' }} - Sophos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    
    <x-layouts.sidebar />

    {{ $slot }}

    @livewireScripts
    <script data-navigate-once src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</body>

</html>
