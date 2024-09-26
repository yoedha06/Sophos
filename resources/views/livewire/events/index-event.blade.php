<x-layouts.sidebar-tabs id-computer="{{ $id_computer }}">
    <div class="max-w-screen-xl mx-auto pt-2 pl-2 border-b">
        <div class="flex flex-col">
            <div>
                <div class="flex mb-2 border-white-300">
                    <a wire:navigate href="/details/{{ $computer->id_computer }}" id="tab-summary"
                        onclick="setActiveTab('summary')"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 rounded-l border-transparent focus:outline-none hover:border-gray-400"">
                        <i class="fa-solid fa-circle-info"></i>&nbsp;Summary
                    </a>
                    <button id="tab-events" onclick="setActiveTab('events')"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-white bg-blue-600 border-blue-600">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;Events
                    </button>
                    <button id="tab-status" onclick="setActiveTab('status')"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-r focus:outline-none hover:border-gray-400">
                        <i class="fa-solid fa-circle-check"></i>&nbsp;Status
                    </button>
                    <button id="tab-policies" onclick="setActiveTab('policies')"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-r focus:outline-none hover:border-gray-400">
                        <i class="fa-solid fa-shield-halved"></i>&nbsp;Policies
                    </button>
                    <button type="button" wire:click="fecth"
                        class="flex items ml-2 mx-auto  text-white text-sm px-5 py-2.5 text-center me-2 bg-blue-800 rounded"
                        wire:loading.remove>Syncronize</button>

                    <button disabled wire:loading.class="cursor-not-allowed" type="button"
                        class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center"
                        wire:loading>
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor" />
                        </svg>
                        Loading...
                    </button>
                </div>
            </div>
        </div>

        <script>
            function setActiveTab(tab) {
                // Reset all buttons to inactive
                document.getElementById('tab-summary').className =
                    'flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent focus:outline-none hover:border-gray-400';
                document.getElementById('tab-events').className =
                    'flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent focus:outline-none hover:border-gray-400';
                document.getElementById('tab-status').className =
                    'flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent focus:outline-none hover:border-gray-400';
                document.getElementById('tab-policies').className =
                    'flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent focus:outline-none hover:border-gray-400';

                // Set the active tab's button
                document.getElementById(`tab-${tab}`).className =
                    'flex items-center py-1 px-4 m-1 font-semibold text-sm text-white bg-blue-600 border-blue-600 focus:outline-none';
            }
        </script>

    </div>
    <div class="max-w-screen-xl">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-t">
            <thead class="bg-white border-b">
                <tr>
                    <th scope="col " class="px-2 py-3">
                        <div id="date-range-picker" date-rangepicker class="flex items-center">
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="datepicker-range-start" name="start" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date start">
                            </div>
                            <span class="mx-4 text-gray-500">to</span>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="datepicker-range-end" name="end" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date end">
                            </div>
                            {{-- <select id="perPage" class="ml-2 border-gray-300 bg-gray-100 rounded float-end">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select> --}}
                        </div>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <h4 class="text-sm text-blue-500 float-end mt-2">View Event Report</h4>
                    </th>
                </tr>
            </thead>
        </table>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-md text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="w-9/10 px-6 py-3">
                        Date
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Event
                    </th>
                </tr>
            </thead>
            <tbody class="text-xs text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-400">
                @foreach ($events as $event)
                    <tr
                        class="text-sm border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ carbon\Carbon::parse($event->event_create_at)->format('M d, Y h:i A') }}
                        </td>
                        <td class="px-8 py-4">
                            {{ $event->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-1 p-1">
            {{ $events->links() }}
        </div>
    </div>
</x-layouts.sidebar-tabs>
