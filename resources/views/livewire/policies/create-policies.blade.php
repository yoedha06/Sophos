<div>
    <div class="content mb-10">
        <nav class="bg-gray-50 dark:bg-gray-700 border-b">
            <div class="max-w-screen-xl px-4 py-3">
                <div class="flex flex-col">
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h1 class="text-3xl font-semibold">Endpoint Protection - Create New Computer Policy</h1>
                        </li>
                    </ul>
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h5 class="text text-gray-300">
                                <span class="text-blue-500">Overview </span> /
                                <span class="text-blue-500">Endpoint Protection Dashboard</span> /
                                <span class="text-blue-500">Computer Policies</span> /
                                <span class="text-gray-400">Create New Computer Policy</span>
                            </h5>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <form wire:submit.prevent='create'>
            <div class="grid grid-cols-1 mx-5 py-4 gap-2 lg:grid-cols-2 lg:gap-2">
                <div class="h-auto px-5 py-2 rounded-lg bg-gray-50">
                    @include('livewire.includes.alerts.success')
                    @include('livewire.includes.alerts.error')
                    <div class="mb-2">
                        <label for="type" class="block text-sm font-medium text-gray-900">Select Type <span
                                class="text-red-500">*</span></label>
                        <select wire:model="type" wire:change="applies"
                            class="w-full shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg">
                            <option value="">Please Select</option>
                            <option value="application-control">Application Control</option>
                            <option value="windows-firewall">Windows Firewall</option>
                            <option value="peripheral-control">Peripheral Control</option>
                            <option value="threat-protection">Threat Protection</option>
                            <option value="web-control">Web Control</option>
                            <option value="data-loss-prevention" class="text-red-500" disabled>Data Loss Prevention - no
                                detected</option>
                            <option value="update-management" class="text-red-500" disabled>Update Management - no
                                detected</option>
                        </select>
                        @error('type')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                            Policy Name <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="name" type="text" id="name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-5 flex gap-2 mb-2">
                        <i class="fas fa-circle-info"></i>
                        <p class="text-sm font-medium text-gray-900">
                            Please select one option: either "Apply To" (for users or computers) or "Apply To Group" (for computers only).
                        </p>
                    </div>                    
                    <div class="mb-3">
                        <label for="group" class="block text-sm font-medium text-gray-900">
                            Apply To
                        </label>
                        <select wire:model.live="group" wire:change="applies" 
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-blue-500 block w-full">
                            <option value="">Select</option>
                            @switch($type)
                                @case('windows-firewall')
                                    <option value="device">Computers</option>
                                    @break
                        
                                @case('web-control')
                                    <option value="user">Users</option>
                                    @break
                        
                                @default
                                    <option value="device">Computers</option>
                                    <option value="user">Users</option>
                            @endswitch
                        </select>
                        @error('group')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>
                    @if($type != 'web-control' && $group !== 'user')
                        <div class="mb-3">
                            <label for="group" class="block text-sm font-medium text-gray-900">
                                Apply To Groups
                            </label>
                            <select wire:model.live="groupComputer" wire:change="applies"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-blue-500 block w-full">
                                <option value="">Select</option>
                                <option value="endpoints">Grup Computers</option>
                            </select>
                            @error('groupComputer')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="inline-flex items-center mb-5 cursor-pointer">
                            <input wire:model.live="settingType" type="checkbox" value="" class="sr-only peer">
                            <div
                                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-violet-500 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-gradient-to-r from-violet-500 to-black">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Settings&nbsp;
                                @if (empty($type) && $settingType)
                                    <span class="text-red-500">- Please select a type before enabling settings</span>
                                @endif
                            </span>
                        </label>
                    </div>
                    <button type="submit" class="w-full bg-gradient-to-r from-black to-violet-800 hover:from-black hover:to-violet-600 text-white font-bold py-2 px-4 rounded">Submit</button>
                </div>
                <div class="flex flex-col gap-y-4">
                    @if ($group === 'device')
                        <div class="h-auto bg-white">
                            <div class="flex justify-between w-full rounded-tr-md rounded-tl-md py-3 font-bold bg-gradient-to-r from-violet-800 to-black text-white">
                                <span class="mx-4 text-md">Available Computers</span>
                                <span class="mx-4 text-md">{{ $computers }}</span>
                            </div>
                            <div class="relative">
                                <label for="Search" class="sr-only"> Search </label>

                                <input type="text" id="Search" wire:model.live="searchDevice"
                                    placeholder="Search"
                                    class="w-full rounded-sm border-gray-200 py-2.5 pe-10 shadow-sm sm:text-sm" />

                                <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
                                    <button type="button" class="text-gray-600 hover:text-gray-700">
                                        <span class="sr-only">Search</span>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                            <div class="max-h-72 overflow-y-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-md text-center text-gray-700 capitalize bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th width="20%">
                                                <div class="relative inline-block group">
                                                    <div class="hover:cursor-pointer">
                                                        <i class="fa fa-xl fa-circle-info"></i>
                                                    </div>
                                                    <div
                                                        class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 w-48 bg-white text-black text-xs rounded-lg shadow-lg p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                                        Pilih salah satu atau lebih untuk apply policies
                                                    </div>
                                                </div>
                                            </th>
                                            <th class="text-left py-3">
                                                <span class="text-left text-md">Computers</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($endpoints as $ep)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td scope="row"
                                                    class="text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <input type="checkbox" wire:model="selectedEndpoints"
                                                        value="{{ $ep->id_computer }}"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                </td>
                                                <td
                                                    class="font-medium flex py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6 mr-2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                                    </svg>{{ $ep->hostname }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if ($group === 'user')
                        <div class="h-auto rounded-lg bg-white">
                            <div
                                class="flex justify-between w-full rounded-tr-md rounded-tl-md py-3 font-bold bg-gradient-to-r from-violet-800 to-black text-white">
                                <span class="mx-4 text-md">Available User</span>
                                <span class="mx-4 text-md">{{ $user }}</span>
                            </div>
                            <div class="relative">
                                <label for="Search" class="sr-only"> Search </label>

                                <input type="text" wire:model.live="searchUser" id="Search"
                                    placeholder="Search"
                                    class="w-full rounded-sm border-gray-200 py-2.5 pe-10 shadow-sm sm:text-sm" />

                                <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
                                    <button type="button" class="text-gray-600 hover:text-gray-700">
                                        <span class="sr-only">Search</span>

                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                        </svg>
                                    </button>
                                </span>
                            </div>
                            <div class="max-h-72 overflow-y-auto">
                                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                    <thead
                                        class="text-md text-center text-gray-700 capitalize bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th width="20%">
                                                <div class="relative inline-block group">
                                                    <div class="hover:cursor-pointer">
                                                        <i class="fa fa-xl fa-circle-info"></i>
                                                    </div>
                                                    <div
                                                        class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 w-48 bg-white text-black text-xs rounded-lg shadow-lg p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                                        Pilih salah satu atau lebih untuk apply policies
                                                    </div>
                                                </div>
                                            </th>

                                            <th class="text-left py-3">
                                                <span class="text-left text-md">User</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $us)
                                            <tr
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                <td scope="row"
                                                    class="text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    <input type="checkbox" wire:model="selectedUsers"
                                                        value="{{ $us->id_user }}"
                                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 name=""
                                                        id="">
                                                </td>
                                                <td
                                                    class="font-medium flex py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-6 h-6 mr-2">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                                    </svg>{{ $us->name }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if($type != 'web-control' && $group !== 'user')
                        @if ($groupComputer === 'endpoints')
                            <div class="h-32 bg-white">
                                <div class="flex justify-between w-full rounded-tr-md rounded-tl-md py-3 font-bold bg-gradient-to-r from-violet-800 to-black text-white">
                                    <span class="mx-4 text-md">Available Grup Computers</span>
                                    <span class="mx-4 text-md">{{ $groupCount }}</span>
                                </div>
                                <div class="relative">
                                    <label for="Search" class="sr-only">Search</label>

                                    <input type="text" id="Search" wire:model.live="searchGrupComputer"
                                        placeholder="Search"
                                        class="w-full rounded-sm border-gray-200 py-2.5 pe-10 shadow-sm sm:text-sm" />

                                    <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
                                        <button type="button" class="text-gray-600 hover:text-gray-700">
                                            <span class="sr-only">Search</span>

                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                            </svg>
                                        </button>
                                    </span>
                                </div>
                                <div class="max-h-72 overflow-y-auto">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-md text-center text-gray-700 capitalize bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th width="20%">
                                                    <div class="relative inline-block group">
                                                        <div class="hover:cursor-pointer">
                                                            <i class="fa fa-xl fa-circle-info"></i>
                                                        </div>
                                                        <div
                                                            class="absolute left-full top-1/2 transform -translate-y-1/2 ml-2 w-48 bg-white text-black text-xs rounded-lg shadow-lg p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
                                                            Pilih salah satu atau lebih untuk apply policies
                                                        </div>
                                                    </div>
                                                </th>
                                                <th class="text-left py-3">
                                                    <span class="text-left text-md">Grup Computers</span>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($groupComputers as $gc)
                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                    <td scope="row"
                                                        class="text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                        <input type="checkbox" wire:model="selectedGroupComputers"
                                                            value="{{ $gc->id_group }}"
                                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                    </td>
                                                    <td
                                                        class="font-medium flex py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="w-6 h-6 mr-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                                        </svg>{{ $gc->name }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div class="grid grid-cols-1 mx-5 py-4 gap-2 lg:grid-cols-2 lg:gap-2">
                @if ($settingType && $type)
                    @if ($type === 'application-control')
                        @include('livewire.policies.settings.application-control')
                    @endif
                    @if ($type === 'windows-firewall')
                        @include('livewire.policies.settings.windows-firewall')
                    @endif
                    @if ($type === 'peripheral-control')
                        @include('livewire.policies.settings.peripheral-control')
                    @endif
                    @if ($type === 'web-control')
                        @include('livewire.policies.settings.web-control')
                    @endif
                    @if ($type === 'threat-protection')
                        @include('livewire.policies.settings.threat-protection')
                    @endif
                @endif
            </div>
        </form>
    </div>
</div>
