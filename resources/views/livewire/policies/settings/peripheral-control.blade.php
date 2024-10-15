<div class="grid grid-cols-1 mx-5 py-4 gap-2 lg:grid-cols-2 lg:gap-2">
    <div class="h-50 px-5 py-6 rounded-lg bg-gray-50">
        <span class="mx-3 text-gray-600">
            <strong class="text-black">Manage Peripherals</strong> - set your peripheral settings below
        </span>
        <div class="w-full py-3">
            <div class="flex justify-between w-full py-3 text-white">
                <span class="ml-24">
                    <fieldset>
                        <div class="flex items-center mb-8">
                            <input id="country-option-1" type="radio" name="countries" value="USA" checked
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                            <label for="country-option-1"
                                class="block ms-2  text-sm font-medium text-gray-900 dark:text-gray-300">
                                Disable peripheral control
                            </label>
                        </div>

                        <div class="flex items-center mb-8">
                            <input id="country-option-2" type="radio" name="countries" value="Germany"
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                            <label for="country-option-2"
                                class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Monitor but do not block (all peripherals will be allowed)
                            </label>
                        </div>

                        <div class="flex items-center mb-4">
                            <input id="country-option-3" type="radio" name="countries" value="Spain"
                                class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                            <label for="country-option-3"
                                class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                Control access by peripheral type and add exemptions
                            </label>
                        </div>
                    </fieldset>
                </span>
            </div>
            <div class="grid-cols-1 mx-5 py-4 gap-2 lg:grid-cols-2 lg:gap-2">
                <span class="text-xs text-black">The totals listed below include all peripherals detected, whether on
                    endpoint computers or servers:</span>

            </div>
            <table class="w-full border-black py-4 mt-3">
                <tbody>
                    <tr>
                        <td width="40%">
                            <select name="HeadlineAct" id="HeadlineAct"
                                class="w-full h-9 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                <option value="">Allow</option>
                                <option value="">Block</option>
                            </select>
                        </td>
                        <td width="40%"><span class="text-center px-2 py-5 text-sm">Bluetooth - 0 detected</span>
                        </td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <select name="HeadlineAct" id="HeadlineAct"
                                class="w-full h-9 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                <option value="">Allow</option>
                                <option value="JM">Read Only</option>
                                <option value="SRV">Block</option>
                            </select>
                        </td>
                        <td width="40%"><span class="text-center px-2 py-5 text-sm">Secure removable storage - 0
                                detected</span></td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <select name="HeadlineAct" id="HeadlineAct"
                                class="w-full h-9 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                <option value="">Allow</option>
                                <option value="JM">Read Only</option>
                                <option value="SRV">Block</option>
                            </select>
                        </td>
                        <td width="40%"><span class="text-center px-2 py-5 text-sm">Floppy drive - 0 detected</span>
                        </td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <select name="HeadlineAct" id="HeadlineAct"
                                class="w-full h-9 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                <option value="">Allow</option>
                                <option value="">Block</option>
                            </select>
                        </td>
                        <td width="40%"><span class="text-center px-2 py-5 text-sm">Infrared - 0 detected</span></td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <select name="HeadlineAct" id="HeadlineAct"
                                class="w-full h-9 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                <option value="">Allow</option>
                                <option value="">Block</option>
                            </select>
                        </td>
                        <td width="40%"><span class="text-center px-2 py-5 text-sm">Modem - 0 detected</span></td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <select name="HeadlineAct" id="HeadlineAct"
                                class="w-full h-9 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                <option value="">Allow</option>
                                <option value="JM">Read Only</option>
                                <option value="SRV">Block</option>
                            </select>
                        </td>
                        <td width="40%"><span class="text-center px-2 py-5 text-sm">Optical drive - 0
                                detected</span></td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <select name="HeadlineAct" id="HeadlineAct"
                                class="w-full h-9 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                <option value="">Allow</option>
                                <option value="JM">Read Only</option>
                                <option value="SRV">Block</option>
                            </select>
                        </td>
                        <td width="40%"><span class="text-center px-2 py-5 text-sm">Removable storage - 3
                                detected</span></td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <select name="HeadlineAct" id="HeadlineAct"
                                class="w-full h-9 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                <option value="">Allow</option>
                                <option value="JM">Block Bridge</option>
                                <option value="SRV">Block</option>
                            </select>
                        </td>
                        <td width="40%"><span class="text-center px-2 py-5 text-sm">Wireless - 1 detected</span>
                        </td>
                    </tr>
                    <tr>
                        <td width="40%">
                            <select name="HeadlineAct" id="HeadlineAct"
                                class="w-full h-9 rounded-lg border-gray-300 text-gray-700 sm:text-sm">
                                <option value="">Allow</option>
                                <option value="EC">Block</option>
                            </select>
                        </td>
                        <td width="40%"><span class="text-center px-2 py-5 text-sm">MTP/PTP - 0 detected</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="mt-4 rounded-md w-full h-14 bg-gray-200">
                <div class="flex justify-between h-full">
                    <span class="text-left px-2 mx-5 py-5 text-sm text-gray-400 font-semibold">Peripheral
                        exemptions</span>
                    <span class="text-center px-2 mx-5 py-5 text-sm text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </span>
                </div>
            </div>
            <div class="grid w-full text-black text-lg mt-5">
                <span class="mt-2 mb-3">Desktop Messaging</span>
                <span class="flex justify-between">
                    <label class="inline-flex items-center mb-5 cursor-pointer">
                        <input type="checkbox" value="" class="sr-only peer" checked>
                        <div
                            class="relative w-12 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[5px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Enable Desktop
                            Messaging for Application Control</span>
                    </label>
                    <span class="float-end text-gray-900"><i class="fas fa-check text-green-500"></i></span>
                </span>
            </div>
            <div class="grid w-full text-black text-sm">
                <span class="text-center text-gray-400 mb-2">Configure a message to be added to the end of the standard
                    notification</span>
                <textarea class="rounded-md mx-14 border-gray-400 h-12" name="" id=""></textarea>
                <span class="mx-14">Note: Custom messages will not be displayed for Intercept X events.</span>
            </div>
        </div>
    </div>
</div>
