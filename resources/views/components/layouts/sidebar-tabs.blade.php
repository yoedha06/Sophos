@props(['idComputer'])
@php
    $computer = \App\Models\Computer::where('id_computer', $idComputer)->first();
@endphp
<div class="content">
    <nav class="bg-gray-50 dark:bg-gray-700 border-b">
        <div class="max-w-screen-xl px-4 py-3 mx-auto">
            <div class="flex flex-col">
                <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                    <li>
                        <h1 class="text-3xl font-semibold">Endpoint Protection - {{ $computer->hostname }}</h1>
                    </li>
                </ul>
                <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                    <li>
                        <h5 class="text text-gray-300">
                            <span class="text-blue-600">Overview </span> /
                            <span class="text-blue-600">Endpoint Protection Dashboard</span> /
                            <span class="text-blue-600"> Computers </span> /
                            <span class="text-gray-300">{{ $computer->hostname }}</span>
                        </h5>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="flex">
        <aside class="w-1/6 bg-white dark:bg-gray-800 p-4 text-center border-r">
            <h4 class="text-xs mb-4">{{ $computer->hostname }}</h4>
            <h5 class="text-xs mb-4">{{ $computer->operating_system['name'] }}</h5>
            <h5 class="text-xs mb-4">IP:
                @php
                    $ips = collect($computer->ipv4_addresses);
                @endphp
                {{ $ips->implode(', ') }}
            </h5>
            <h5 class="text-xs mb-4">Last User: - </h5>
            <h5 class="text-xs text-blue-600 mb-4">Admin Isolate</h5>
            <button class="mx-auto w-full p-1 mb-1 text-xs font-semibold text-white bg-blue-800 rounded">Update
                Now</button>
            <button
                class="mx-auto w-full p-1 mb-1 text-xs font-semibold text-blue-800 bg-gray-300 rounded">Delete</button>
            <button
                class="mx-auto w-full p-1 mb-5 text-xs font-semibold text-gray-400 bg-gray-300 rounded cursor-not-allowed"
                disabled>Live Response</button>
            <button class="mx-auto w-full p-1 text-xs font-semibold text-blue-800 bg-gray-300 rounded">More
                actions</button>
        </aside>
        <main class="flex-grow">
            {{ $slot }}
        </main>
    </div>
</div>