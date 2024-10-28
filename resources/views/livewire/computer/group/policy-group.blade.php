<div>
    <div class="content bg-white">
        <nav class="bg-gray-50 dark:bg-gray-700 border-b">
            <div class="max-w-screen-xl px-4 py-3 mx-auto">
                <div class="flex flex-col">
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h1 class="text-3xl font-semibold">Endpoint Protection - {{ $groups->name }}</h1>
                        </li>
                    </ul>
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h5 class="text text-gray-300">
                                <span class="text-blue-500">Overview </span> /
                                <span class="text-blue-500">Endpoint Protection Dashboard</span> /
                                <a href="{{ route('computer.group') }}" wire:navigate><span class="text-blue-500"> Computers Groups</span></a> /
                                <span class="text-gray-400">{{ $groups->name }}</span>
                            </h5>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="flex min-h-screen">
            <aside class="w-1/6 bg-white dark:bg-gray-800 p-4 text-center border-r">
                <h4 class="text-5xl mb-10 pt-14"><i class="fa-solid fa-window-restore fa-2xl"></i></h4>
                <h4 class="text-xs mb-4"></h4>
                <h5 class="text-xs mb-4"></h5>
                <h5 class="text-xs mb-4 text-gray-500">{{ $groups->name }}</h5>
                <span class="flex gap-1 mx-14 text-gray-500">
                    <a wire:navigate href="{{ route('group.edit', $groups->id_group)}}" class="text-xs py-1 text-blue-500">Edit</a>
                    |
                    <a wire:click="deleteGroup('{{ $groups->id_group }}')" wire:confirm="Are you sure you want to delete this Group?" class="text-xs py-1 text-blue-500 cursor-pointer">
                        Delete
                    </a>
                </span>
            </aside>
            <main class="flex-grow">
                <div class="max-w-screen-xl mx-auto pt-2 pl-2 border-b">
                    <div class="flex flex-col">
                        <div>
                            <div class="flex mb-2 border-white-300">
                                <a href="{{ route('show.group', $groups->id_group) }}" wire:navigate  id="tab-summary"
                                    class="flex items-center py-2 px-4 font-semibold text-sm rounded-l  text-gray-700 bg-gray-200 border-transparent focus:outline-none hover:border-gray-400">
                                    <i class="fa-solid fa-circle-info"></i>&nbsp;Summary
                                </a>
                                <a href="{{ route('policy.group', $groups->id_group) }}" wire:navigate  id="tab-policies"
                                    class="flex items-center py-2 px-4 font-semibold text-sm text-white bg-gradient-to-l from-violet-900 to-blue-400 rounded-r">
                                    <i class="fa-solid fa-shield-halved"></i>&nbsp;Policies
                                </a>             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full pb-10">
                    <table class="px-2 py-2 ms-4 mt-3 text-xl mb-4">
                        <tbody>
                            <th class="text-md font-normal"><i class="fas fa-circle-info"></i><span class="text-sm text-gray-600"> Policies below apply to {{ $groups->name }}.</span></th>
                        </tbody>
                    </table>
                    <div class="px-4">
                        <table class="w-full border-t-4 border-l-2 border-b-2 px-5 py-1 text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-md text-gray-700 border-b bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="text-md text-gray-700 bg-white dark:bg-gray-700 dark:text-gray-400">
                                @foreach($policyGroup as $policy)
                                    <tr class="border-b border-r">
                                        <td scope="col" class="px-6 capitalize py-3">Endpoint Protection: {{ $policy->type }}</td>
                                        <td scope="col" class="px-6 py-3"><a href="" class="text-blue-600">{{ $policy->name }}</a></td>
                                    </tr>
                                @endforeach
                            </tbody>                
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
