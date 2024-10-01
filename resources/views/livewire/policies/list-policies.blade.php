<div>
    <div class="content bg-white">
        <nav class="bg-gray-50 dark:bg-gray-700 border-b">
            <div class="max-w-screen-xl px-4 py-3 mx-auto">
                <div class="flex flex-col">
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h1 class="text-3xl font-semibold">Endpoint Protection - Policies</h1>
                        </li>
                    </ul>
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h5 class="text text-gray-300">
                                <span class="text-blue-500">Overview </span> /
                                <span class="text-blue-500">Endpoint Protection Dashboard</span> /
                                <span class="text-gray-400">Policies</span>
                            </h5>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <table class="w-full text-sm text-left dark:text-gray-400 border-b mb-2">
            <thead class="text-xs bg-slate-100">
                <tr>
                    <th scope="col" class="px-6 py-2">
                        <form class="flex items-left max-w-sm">
                            <div class="relative w-full">
                                <input type="text" id="simple-search"
                                    class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full   dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search" required />
                            </div>
                            <button type="submit"
                                class="p-2.5 ms-1 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                                <span class="sr-only">Search</span>
                            </button>
                        </form>
                    </th>
                    <th scope="col" class="px-6 py-4 float-end">
                        <button class="bg-blue-700 py-1 px-2 rounded-lg mr-5 text-white">Add Policy</button>
                    </th>
                </tr>
            </thead>
        </table>
        <span class="text-black-400 ml-5 mb-5"><i class="fa-solid fa-xl fa-circle-info"></i>&nbsp;<span
                class="text-sm">Note: The policies at the top of the list override the policies at the bottom of the
                list.</span></span>

        <div class="px-4 py-2">
            @foreach ($policies as $type => $policyGroup)
                <table
                    class="w-full border-t border-l border-r bg-gray-100 border-b px-5 text-sm text-left text-gray-500 dark:text-gray-400">
                    <tbody class="text-md text-white bg-gradient-to-r from-violet-900 to-blue-400 dark:bg-gray-700 dark:text-gray-400">
                        <tr class="text-md">
                            <td class="px-5 py-3 font-bold text-md">{{ $type }} ({{ $policyGroup->count() }})
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="w-full border-l border-r py-1 text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-md text-gray-700 border-b bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-14 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Type (single / group)</th>
                            <th scope="col" class="px-6 py-3">Last Modified</th>
                        </tr>
                    </thead>
                    <tbody class="text-md text-left text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-400 border-">
                        @foreach ($policyGroup as $policy)
                            <tr
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-14 py-3 font-medium text-blue-500 whitespace-nowrap dark:text-white">
                                    <a href="#">{{ $policy->name }}</a>
                                </td>
                                <td class="px-6 py-3 font-medium whitespace-nowrap dark:text-white">
                                    <i class="fas fa-check text-green-500"></i>&nbsp;<a
                                        href="#">{{ $policy->enabled ? 'Enabled' : 'Disabled' }}</a>
                                </td>
                                <td class="px-6 py-3 text-left font-medium whitespace-nowrap dark:text-white">
                                    <a href="#">
                                        -
                                    </a>
                                </td>
                                <td class="px-6 py-3 font-medium whitespace-nowrap dark:text-white">
                                    <a href="#">{{ $policy->updated_at->format('M d, Y') }}</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <br>
            @endforeach
        </div>
    </div>
</div>
