<div>
    <div class="content">
        <nav class="bg-gray-50 dark:bg-gray-700">
            <div class="max-w-screen-xl px-4 py-3 mx-auto">
                <div class="flex flex-col">
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h1 class="text-3xl font-semibold">Setting Credentials</h1>
                        </li>
                    </ul>
                    <ul class="flex flex-row font-medium mt-0 space-x-8 rtl:space-x-reverse text-sm">
                        <li>
                            <h5 class="text text-gray-300"><span class="text-blue-600">Overview </span> /
                                <span class="text-gray-300">Setting</span>
                            </h5>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="max-w-screen-xl px-2 py-1 mx-auto">
            <h1 class="text-3xl font-semibold text-center">Get Credentials</h1>

            <div class="max-w-sm mx-auto mt-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 p-6">
                <form wire:submit="saveCredentials">
                    <div class="mb-5">
                        <label 
                            for="client_id"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Client ID
                            <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="client_id" 
                            wire:model="clientId"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="client_secret" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Client Secret<span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            id="client_secret" 
                            wire:model="clientSecret"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required />
                    </div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
                </form>
            </div>
        </div>

    </div>
</div>
