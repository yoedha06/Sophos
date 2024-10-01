<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Dashboard' }} - Sophos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body {
            font-family: "Roboto", sans-serif;
        }

        .nav-header h1 {
            font-size: 1.75rem;
            font-weight: bold;
        }

        .sidebar {
            background-color: #1f2937;
            color: #ffffff;
        }

        .sidebar .active {
            background-color: #3b82f6;
            color: white;
        }

        .content {
            margin-top: 4rem;
            margin-left: 16rem;
            padding: rem;
        }

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
