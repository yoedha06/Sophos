<div>
    <div class="content">
        <nav class="bg-gray-50 dark:bg-gray-700 border-b">
            <div class="max-w-screen-xl px-4 py-3">
                <div class="flex flex-col">
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h1 class="text-3xl font-semibold">Endpoint Protection - Add Computer Group</h1>
                        </li>
                    </ul>
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h5 class="text text-gray-300">
                                <span class="text-blue-500">Overview </span> /
                                <span class="text-blue-500">Endpoint Protection Dashboard</span> /
                                <span class="text-gray-400">Add Computer Group</span>
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
                        <label for="name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">
                            Group Name <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="name" type="text" id="name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-violet-500 focus:border-blue-500 block w-full  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" />
                        @error('name')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" wire:model="description" x-data="{
                            resize() {
                                $el.style.height = '40px'
                                $el.style.height = $el.scrollHeight + 'px'
                            }
                        }" x-init="resize" x-on:input="resize"
                        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </textarea>
                        @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="w-full mt-12 bg-gradient-to-r from-black to-violet-800 hover:from-black hover:to-violet-600 text-white font-bold py-2 px-4 rounded">Submit</button>
                </div>
                <div class="h-32 bg-white">
                    <div
                        class="flex justify-between w-full rounded-tr-md rounded-tl-md py-3 font-bold bg-gradient-to-r from-violet-800 to-black text-white">
                        <span class="mx-4 text-md">Available Computers</span>
                        <span class="mx-4 text-md">{{ $computersAvailable->count() }}</span>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-md text-center text-gray-700 capitalize bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th colspan="3">
                                    <div class="relative">
                                        <label for="Search" class="sr-only"> Search </label>

                                        <input type="text" id="Search" wire:model.live="search"
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
                                </th>
                            </tr>
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
                            @foreach ($computersAvailable as $computer)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td scope="row"
                                    class="text-center py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <input type="checkbox" wire:model="endpointIds" value="{{ $computer->id_computer }}"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td class="font-medium flex py-4 text-gray-900 whitespace-nowrap dark:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                    </svg>{{ $computer->hostname }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
