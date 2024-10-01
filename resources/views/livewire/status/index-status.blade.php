<x-layouts.sidebar-tabs id-computer="{{ $id_computer }}">
    <div class="max-w-screen-xl bg-white mx-auto pt-2 mb-8 pl-2 border-b">
        <div class="flex flex-col">
            <div>
                <div class="flex mb-2 border-white-300">
                    <a wire:navigate href="/details/{{ $computer->id_computer }}" id="tab-summary"
                        onclick="setActiveTab('summary')"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 rounded-l border-transparent focus:outline-none hover:border-gray-400"">
                        <i class="fa-solid fa-circle-info"></i>&nbsp;Summary
                    </a>
                    <a wire:navigate href="/events/{{ $computer->id_computer }}" id="tab-events" onclick="setActiveTab('events')"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-l focus:outline-none hover:border-gray-400">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;Events
                    </a>
                    <button id="tab-status" onclick="setActiveTab('status')"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-white bg-blue-600 border-blue-600">
                        <i class="fa-solid fa-circle-check"></i>&nbsp;Status
                    </button>
                    <a wire:navigate href="/policies/{{ $computer->id_computer }}" id="tab-policies" onclick="setActiveTab('policies')"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-r focus:outline-none hover:border-gray-400">
                        <i class="fa-solid fa-shield-halved"></i>&nbsp;Policies
                    </a>

                    <button type="button" wire:click="fecth"
                        class="flex items ml-2 mx-auto text-white text-sm px-5 py-2.5 text-center me-2 bg-blue-800 rounded"
                        wire:loading.remove wire:target="fecth">
                        Syncronize
                    </button>
                    <button disabled wire:loading.class="cursor-not-allowed" type="button"
                        class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center"
                        wire:loading wire:target="fecth">
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
                document.getElementById(`tab-${tab}`).className =
                    'flex items-center py-1 px-4 m-1 font-semibold text-sm text-white bg-blue-600 border-blue-600 focus:outline-none';
            }
        </script>
    </div>
    <div class="max-w-screen-xl ml-5">
        <span class="text-xl ml-5 mt-32 py-4 mb-5">Security Health</span>
        <div class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <div x-data="{ open: true }" class="rounded-md p-2">
                <div>
                    <button @click="open = !open" class="flex items-center justify-between w-full py-2 text-left text-md font-semibold focus:outline-none focus:ring hover:bg-gray-200 rounded-md px-2">
                        <span class="flex items-center">
                            <svg x-show="!open" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            <svg x-show="open" class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                            <i class="fa-solid fa-circle-check" style="color: #00d103;"></i>&nbsp; Security Health
                        </span>
                    </button>
                    <div x-show="open" x-transition class="mt-2">
                        <ul class="list-none list-inside text-sm ml-5">
                            <li class="hover:bg-gray-200 rounded-md p-2">-</li>
                            <li class="hover:bg-gray-200 rounded-md p-2">-</li>
                        </ul>
        
                        <!-- Nested Accordion -->
                        <div x-data="{ openNested: true }" class="ml-5 p-4">
                            <button @click="openNested = !openNested" class="flex items-center justify-between w-full py-2 text-left text-md font-semibold focus:outline-none focus:ring hover:bg-gray-200 rounded-md px-2">
                                <span class="flex items-center">
                                    <svg x-show="!openNested" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    <svg x-show="openNested" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                    <i class="fa-solid fa-circle-check" style="color: #00d103;"></i>&nbsp; Sophos Services Running
                                </span>
                            </button>
                            <div x-show="openNested" x-transition class="mt-2 ml-6">
                                @foreach($healthServices as $service)
                                    <li class="flex items-center hover:bg-gray-200 rounded-md p-2">
                                        @if($service['status'] === 'running')
                                        <i class="fa-solid fa-circle-check" style="color: #00d103;"></i>&nbsp;
                                        @endif
                                        {{ $service['name'] }}
                                    </li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <span class="text-xl ml-5 mt-32 py-4 mb-5">Alerts</span><br>
        <span class="text-sm ml-5 mt-32 py-4 mb-5">No Alerts</span>
    </div>
</x-layouts.sidebar-tabs>
