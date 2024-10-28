<div>
    <div class="content">
        <nav class="bg-gray-50 dark:bg-gray-700">
            <div class="max-w-screen-xl px-4 py-3 mx-auto">
                <div class="flex flex-col"> <!-- Changed from flex-row to flex-col -->
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h1 class="text-3xl font-semibold">Endpoint Protection - Computers Groups</h1>
                        </li>
                    </ul>
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h5 class="text text-gray-300"><span class="text-blue-500">Overview </span> / <span
                                    class="text-blue-500">Endpoint Protection Dashboard</span> / <span
                                    class="text-gray-400">Computers Groups</span></h5>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="max-w-screen-xl px-1 py-1 mx-auto">
            <div class="flex flex-col">
                <div>
                    <div class="flex mb-4 border-gray-300">
                        <button wire:navigate href="{{ route('index.computer') }}"
                            class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-l focus:outline-none hover:border-gray-400"
                            onclick="setActiveTab('computers')">
                            <i class="fa-solid fa-display"></i>&nbsp;
                            Computers
                        </button>
                        <button
                            class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent focus:outline-none hover:border-gray-400"
                            onclick="setActiveTab('unmanaged')">
                            <i class="fa-solid fa-circle-question"></i>&nbsp;
                            Unmanaged Computers
                        </button>
                        <button
                            class="flex items-center py-2 px-4 font-semibold text-sm text-white bg-gradient-to-l from-violet-900 to-blue-400 rounded-r
                            onclick="setActiveTab('group')">
                            <i class="fa-solid fa-user-group"></i>&nbsp;
                            Computer Groups
                        </button>

                        <button type="button" 
                            wire:click="fecth" 
                            class="flex items ml-2 mx-auto text-white text-sm px-5 py-2.5 text-center me-2 bg-gradient-to-l from-violet-900 to-blue-400 rounded" 
                            wire:loading.remove 
                            wire:target="fecth">Syncronize
                        </button>

                        <button disabled 
                            wire:loading.class="cursor-not-allowed" 
                            type="button" 
                            class="ml-2 text-white bg-gradient-to-l from-violet-900 to-blue-400 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 inline-flex items-center" 
                            wire:loading 
                            wire:target="fecth">
                            <svg aria-hidden="true" role="status" class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="#E5E7EB"/>
                                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentColor"/>
                            </svg>
                            Loading...
                        </button>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between border-b items-center pb-2" style="margin-left: 20px;">
                        <div class="flex space-x-1">
                            <a wire:navigate href="{{ route('create.group') }}" class="px-4 ms-5 font-semibold py-1 text-xs bg-blue-700 text-white rounded">
                                Add Computer Group
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="float-end w-80 px-5 mb-2">
            <div class="relative">
                <label for="Search" class="sr-only"> Search </label>
                <input type="text" id="Search" placeholder="Search..." class="w-full rounded-md border-gray-200 py-2.5 pe-10 shadow-sm sm:text-sm"/>
            
                <span class="absolute inset-y-0 end-0 grid w-10 place-content-center">
                <button type="button" class="text-gray-600 hover:text-gray-700">
                    <span class="sr-only">Search</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                    </svg>
                </button>
                </span>
            </div>
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-gray-700 border-t bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 flex gap-2">
                        <input type="checkbox" class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        Name (Nested Groups)
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Computers
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="px-2 py-2 bg-gray-100 border-b">
                @foreach($groups as $group)
                    <tr class="border-b hover:bg-gray-200">
                        <td scope="col" class="px-6 py-5 flex gap-2" width="60%">
                            <input type="checkbox" class="text-center w-5 h-5  text-blue-600 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <a href="{{ route('show.group', $group->id_group) }}" wire:navigate class="flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                </svg>                          
                                <span class="text-center py-1 text-blue-500">{{ $group->name }}</span>
                            </a>
                        </td>
                        <td scope="col" class="px-6 py-3" width="20%">{{ $group->total_assigned }}</td>
                        <td scope="col" class="px-6 py-3" width="25%">{{ $group->description }}</td>
                        <td scope="col" class="px-6 py-3 text-center" width="10%">
                            <span class="inline-flex overflow-hidden rounded-md border bg-white shadow-sm">
                                <a href="{{ route('group.edit', $group->id_group) }}" wire:navigate class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative" title="Edit Product">
                                    <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4">
                                    <path
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"
                                    />
                                  </svg>
                                </a>
                                <button wire:click="deleteGroup('{{ $group->id_group }}')" wire:confirm="Are you sure you want to delete this Group?" class="inline-block p-3 text-gray-700 hover:bg-gray-50 focus:relative" title="Delete Product">
                                    <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.5"
                                    stroke="currentColor"
                                    class="size-4"
                                    >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"
                                    />
                                    </svg>
                                </button>
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
