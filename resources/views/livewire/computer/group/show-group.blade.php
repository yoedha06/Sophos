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
        <div class="flex h-screen">
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
                                    class="flex items-center py-2 px-4 font-semibold text-sm text-white bg-gradient-to-l from-violet-900 to-blue-400 rounded-l">
                                    <i class="fa-solid fa-circle-info"></i>&nbsp;Summary
                                </a>
                                <a href="{{ route('policy.group', $groups->id_group) }}" wire:navigate  id="tab-policies"
                                    class="flex items-center py-2 px-4 font-semibold text-sm text-gray-700 bg-gray-200 border-transparent rounded-r focus:outline-none hover:border-gray-400">
                                    <i class="fa-solid fa-shield-halved"></i>&nbsp;Policies
                                </a>             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full border-b pb-10">
                    <table class="px-2 py-2 ms-4 mt-3 text-xl mb-4">
                        <tbody>
                            <th class="text-md font-normal">Group Details</th>
                        </tbody>
                    </table>
                    <table class="px-2 py-2 ms-4 text-xl">
                        <tbody>
                            <tr>
                                <td class="text-left text-sm" style="vertical-align: top; padding-top:5px;" width="50%">Group Description</td>
                                @if($groups->description)
                                    <td class="px-5 py-1 text-sm w-full" width="80%">{{ $groups->description }}</td>
                                @elseif($groups->description == null)
                                    <td class="px-20 py-1 text-sm">No Description</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
                <table class="px-2 mt-5 py-6 ms-4 text-xl">
                    <tbody>
                        <th class="text-md font-normal">Group Members</th>
                    </tbody>
                </table>
                <table class="px-2 py-2 ms-4 text-xl">
                    <thead>
                        @if($countComputerGroups > 0)
                            <tr class="border-b-2 border-t-2">
                                <th class="px-4 py-4 text-sm text-left text-gray-500 bg-gray-50" width="40%">
                                    {{ $countComputerGroups }} Group Members
                                </th>
                            </tr>
                        @else
                            <tr class="border-b-2 border-t-2">
                                <th class="px-4 py-4 text-sm text-left text-gray-500 bg-gray-50" width="40%">
                                    0 Group Members
                                </th>
                            </tr>
                        @endif
                    </thead>
                    <tbody>
                        @forelse($computerGroups as $group)
                            <tr>
                                <td class="px-4 py-4 flex border-b-2">
                                    <svg class="w-5 h-5 mr-2" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 452.986 452.986"
                                    xml:space="preserve">
                                    <g>
                                        <path style="fill:#010002;" d="M165.265,53.107L21.689,81.753v132.531l143.575-2.416V53.107 M431.297,245.583l-233.18-3.991
                                            v164.822l233.18,46.571V245.583 M165.265,241.097l-143.575-2.438v132.509l143.575,28.668V241.097 M431.297,0l-233.18,46.528
                                            v164.822l233.18-3.969V0" />
                                    </g>
                                </svg>
                                <span class="text-sm ms-2">{{ $group->hostname }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr class="px-5 py-6">
                                <td class="text-center py-2 text-sm text-gray-500">
                                    <span>No members</span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </main>
        </div>
    </div>
</div>
