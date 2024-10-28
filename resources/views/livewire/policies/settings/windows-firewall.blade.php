<div class="h-50 px-5 py-2 rounded-lg bg-gray-50">
    <span class="mx-2 px-2 py-2 text-xs"><i class="fa fa-circle-info fa-xl"></i>
        &nbsp; Windows Group Policy settings may affect policy application on individual computers.
    </span>
    <div class="w-full mt-5 py-3">
        <span class="text-lg mx-3 font-bold">Monitor Type</span>
        <div class="flex justify-between w-full py-3 text-white">
            <span class="mx-2">
                <fieldset>
                    <div class="flex items-center mb-4">
                        <input id="country-option-1" type="radio" name="countries"
                            value="USA"
                            class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="country-option-1"
                            class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                            Don't Monitor - Endpoints won't report firewall status to Sophos Central
                        </label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="country-option-2" type="radio" name="countries"
                            value="Germany"
                            class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600"
                            checked>
                        <label for="country-option-2"
                            class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Monitor Only - Endpoints will report firewall status to Sophos Central
                        </label>
                    </div>

                    <div class="flex items-center mb-4">
                        <input id="country-option-3" type="radio" name="countries"
                            value="Spain"
                            class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                        <label for="country-option-3"
                            class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Monitor & Configure Network Profiles
                        </label>
                    </div>
                </fieldset>

            </span>
        </div>
    </div>
</div>