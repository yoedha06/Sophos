<x-layouts.sidebar-tabs id-computer="{{ $id_computer }}">
    <div class="max-w-screen-xl mx-auto pt-2 pl-2 border-b">
        <div class="flex flex-col">
            <div>
                <div class="flex mb-2 border-white-300">
                    <a wire:navigate href="/details/{{ $computer->id_computer }}" id="tab-summary"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-white bg-gradient-to-l from-violet-900 to-blue-400 rounded-l">
                        <i class="fa-solid fa-circle-info"></i>&nbsp;Summary
                    </a>
                    <a wire:navigate href="/events/{{ $computer->id_computer }}" id="tab-events"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent focus:outline-none hover:border-gray-400">
                        <i class="fa-solid fa-calendar-days"></i>&nbsp;Events
                    </a>
                    <a wire:navigate href="/status/{{ $computer->id_computer }}" id="tab-status"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent focus:outline-none hover:border-gray-400">
                        <i class="fa-solid fa-circle-check"></i>&nbsp;Status
                    </a>
                    <a wire:navigate href="/policies/{{ $computer->id_computer }}" id="tab-policies"
                        class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-r focus:outline-none hover:border-gray-400">
                        <i class="fa-solid fa-shield-halved"></i>&nbsp;Policies
                    </a>
                    <button type="button" wire:click="fecth" class="flex items ml-2 mx-auto  text-white text-sm px-5 py-2.5 text-center me-2 bg-gradient-to-l from-violet-900 to-blue-400 rounded" wire:loading.remove>Syncronize</button>

                    <button disabled wire:loading.class="cursor-not-allowed" type="button" class="ml-2 text-white bg-gradient-to-l from-violet-900 to-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center" wire:loading>
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                        </svg>
                        Loading...
                    </button>                
                </div>
            </div>
        </div>
          
    </div>
    <div class="max-w-screen-xl">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-t">
            <thead class="bg-white border-b">
                <tr>
                    <th scope="col">
                        <h3 class="text-2xl pl-5">Recent Events</h3>
                    </th>
                    <th scope="col" class="px-6 py-3">
                        <h4 class="text-sm text-blue-500 float-end mr-2">View more</h4>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ \Carbon\Carbon::parse($event->when)->format('M d, Y h:i A') }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $event->name }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex">
            <aside class="w-1/4 bg-white dark:bg-gray-800 pl-6 pt-5">
                <h1 class="text-xl mb-3">Agent Summary</h1>
                <h1 class="text-md mb-4 text-gray-600">Last Activity</h1>
                <h1 class="text-md mb-3 text-gray-600">Last Agent Update</h1>
                <h1 class="text-md text-gray-600" style="margin-bottom: 287px;">Assigned Products</h1>
                <h1 class="text-md mb-3 text-gray-600">Group</h1>
                <h1 class="text-md mb-3 text-gray-600">Operating System</h1>
                <h1 class="text-md mb-3 text-gray-600">Processor Architecture</h1>
                <h1 class="text-xl mb-3 text-gray-600">Tamper Protection</h1>
                <h1 class="text-md mb-3 text-gray-600" style="margin-bottom: 130px;">Tamper Protection</h1>
                <h1 class="text-xl mb-3 text-gray-600">Windows Firewall</h1>
                <h1 class="text-md mb-3 text-gray-600">Windows Firewall</h1>
                <h1 class="text-md text-gray-600">Managed by Windows Group</h1>
                <h1 class="text-md mb-3 text-gray-600">Policy</h1>
                <h1 class="text-md mb-6 text-gray-600">Last Active Profiles</h1>
                <h1 class="text-xl mb-1 text-gray-600">Other Registered Firewalls</h1>
                <h1 class="text-md mb-3 text-gray-600">None</h1>
                <h1 class="text-xl mb-3 text-gray-600">Sophos Diagnostic Utility</h1>
                <h1 class="text-md mb-3 text-gray-600">Status</h1>
                <h1 class="text-md mb-3 text-gray-600">Last Run</h1>
            </aside>

            <aside class="w-3/4 bg-white dark:bg-gray-900 pl-6 pt-5 pb-20">
                <p class="text-md mt-10 text-gray-600 dark:text-gray-300">32 minutes ago</p>
                <p class="text-md mt-4 text-gray-600 dark:text-gray-300">
                    19 hours ago<span class="pl-5">Update succesfull</span><span class="pl-5"><i class="fa-solid fa-check" style="color: #00a82a;"></i></span>
                </p>
                <table class="w-full mt-4 mb-2 text-md text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-sm text-gray-500 bg-white border-b">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Licensed
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Assigned
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Version
                            </th>
                        </tr>
                    </thead>
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-blue-500 whitespace-nowrap dark:text-white">
                            {{ $computer->assigned_products[3]['code'] }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <i class="fa-solid fa-check" style="color: #00a82a;"></i>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $computer->assigned_products[3]['version'] }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-blue-500 whitespace-nowrap dark:text-white">
                            {{ $computer->assigned_products[2]['code'] }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <i class="fa-solid fa-check" style="color: #00a82a;"></i>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $computer->assigned_products[2]['version'] }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-blue-500 whitespace-nowrap dark:text-white">
                            {{ $computer->assigned_products[1]['code'] }}

                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <i class="fa-solid fa-check" style="color: #00a82a;"></i>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $computer->assigned_products[1]['version'] }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="px-6 py-4 font-medium text-blue-500 whitespace-nowrap dark:text-white">
                            {{ $computer->assigned_products[4]['code'] }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <i class="fa-solid fa-check" style="color: #00a82a;"></i>
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $computer->assigned_products[4]['version'] }}
                        </td>
                    </tr>
                </tbody>
                </table>
                <span class="p-5"><i class="fa-solid fa-xs fa-chevron-right"></i><span class="text-sm font-semibold ml-5">Installed component version</span></span>
                <div class="p-2">
                    @if(!empty($computer->group['name']))
                        {{ $computer->group['name'] }}
                    @else
                        -
                    @endif
                </div>
                <div class="pl-2">
                    <span class="text-sm">{{ $computer->operating_system['name'] }}</span>
                </div>
                <div class="p-2 mb-9">
                    <span class="text-sm">x64</span>
                </div>

                <div class="p-2">
                    <span class="text-sm">Off</span>
                </div>
                <div class="p-3 mb-9">
                    <div id="alert-border-4" class="flex items-center p-4 mb-4 text-yellow-800 border-t-4 border-yellow-300 bg-yellow-50 dark:text-yellow-300 dark:bg-gray-800 dark:border-yellow-800" role="alert">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <div class="ms-3 text-sm font-medium">
                            You can't turn on tamper protection here because it has been turned off for all your devices. To turn it on, go to <a href="#" class="font-semibold underline hover:no-underline">System Settings</a> > <a href="#" class="font-semibold underline hover:no-underline">Tamper Protection</a>.                                </div>
                    </div>
                </div>
                <div class="p-2">
                    <span class="text-sm">Active <span class="ml-4">(Domain, Private, Public)</span></span>
                </div>
                <div class="p-1 pl-2">
                    <span class="text-sm">no</span>
                </div>
                <div class="pt-8 pl-2">
                    <span class="text-sm">Public</span>
                </div>
                <div class="pt-32 pl-2">
                    <span class="text-sm">Not Running</span>
                </div>
                <div class="p-4 pl-2">
                    <span class="text-sm">Never</span>
                </div>
            </aside>
        </div>
    </div>
</x-layouts.sidebar-tabs>