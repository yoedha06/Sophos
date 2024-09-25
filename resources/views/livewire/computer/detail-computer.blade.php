<div>
    <div class="content">
        <nav class="bg-gray-50 dark:bg-gray-700">
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
            <!-- Sidebar -->
            <aside class="w-1/6 bg-white dark:bg-gray-800 p-4 text-center">
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

            <main class="flex-grow p-2">
                <div class="max-w-screen-xl mx-auto">
                    <div class="flex flex-col">
                        <div>
                            <div class="flex mb-4 border-white-300">
                                <button
                                    class="flex items-center py-2 px-4 font-semibold text-sm text-white bg-blue-500 border-blue-500 rounded-l 
                                    onclick="setActiveTab('computers')">
                                    Sumarry
                                </button>
                                <button
                                    class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-l focus:outline-none hover:border-gray-400"
                                    onclick="setActiveTab('unmanaged')">
                                    Events
                                </button>
                                <button
                                    class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-r focus:outline-none hover:border-gray-400"
                                    onclick="setActiveTab('groups')">
                                    Status
                                </button>
                                <button
                                    class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-r focus:outline-none hover:border-gray-400"
                                    onclick="setActiveTab('groups')">
                                    Policies
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="max-w-screen-xl mx-auto">
                    <h3 class="text-xl font-semibold">Details</h3>
                    <p>Hostname: {{ $computer->hostname }}</p>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ \Carbon\Carbon::parse($event->event_create_at)->format('M d, Y h:i A') }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $event->name }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

</div>
