<script setup>
import TransparentButton from '../../Layouts/Widgets/TransparentButton.vue';


</script>

<template>
    <!----General Table-->
    <div class="m-4 relative overflow-x-auto rounded-xl border border-amber-50">
        <div class="py-4">
            <h3 class="font-bold text-2xl text-gray-600">
                Tenant Arrears
            </h3>
        </div>
        <div class="overflow-x-auto rounded-lg border border-gray-100">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-amber-100 text-amber-900 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="p-4">
                            <input type="checkbox" class="w-4 h-4 border-gray-300 rounded focus:ring-amber-400" />
                        </th>
                        <th class="px-6 py-3 font-semibold">Tenant</th>
                        <th class="px-6 py-3 font-semibold">Balance</th>
                        <th class="px-6 py-3 font-semibold">Due</th>
                        <th class="px-6 py-3 font-semibold text-right">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="p-4">
                            <input type="checkbox" class="w-4 h-4 border-gray-300 rounded focus:ring-amber-400" />
                        </td>
                        <td class="px-6 py-3 text-gray-700 font-medium">
                            Polycarp Ombacho
                        </td>
                        <td class="px-6 py-3 text-gray-600">9,000.00</td>
                        <td class="px-6 py-3 text-gray-600">2026-01-10</td>

                        <td class="px-6 py-3 text-right space-x-2 flex">
                            <button
                                class="inline-flex px-3 py-1.5 text-sm text-amber-700 border border-amber-200 hover:bg-amber-50 rounded-lg transition">
                                <i class="fa-regular fa-eye mr-1 mt-1"></i> View
                            </button>
                            <button
                                class="px-3 py-1.5 text-sm text-white bg-amber-600 hover:bg-amber-700 rounded-lg transition inline-flex">
                                <i class="fa-solid fa-envelope mr-1 mt-1"></i> Remind
                            </button>
                        </td>
                    </tr>
                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="p-4">
                            <input type="checkbox" class="w-4 h-4 border-gray-300 rounded focus:ring-amber-400" />
                        </td>
                        <td class="px-6 py-3 text-gray-700 font-medium">
                            John Doe
                        </td>
                        <td class="px-6 py-3 text-gray-600">99,000.00</td>
                        <td class="px-6 py-3 text-gray-600">2026-01-10</td>

                        <td class="px-6 py-3 text-right space-x-2 flex">
                            <button
                                class="inline-flex px-3 py-1.5 text-sm text-amber-700 border border-amber-200 hover:bg-amber-50 rounded-lg transition">
                                <i class="fa-regular fa-eye mr-1 mt-1"></i> View
                            </button>
                            <button
                                class="px-3 py-1.5 text-sm text-white bg-amber-600 hover:bg-amber-700 rounded-lg transition inline-flex">
                                <i class="fa-solid fa-envelope mr-1 mt-1"></i> Remind
                            </button>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50 transition-colors duration-150">
                        <td class="p-4">
                            <input type="checkbox" class="w-4 h-4 border-gray-300 rounded focus:ring-amber-400" />
                        </td>
                        <td class="px-6 py-3 text-gray-700 font-medium">
                            Lemayen Brian
                        </td>
                        <td class="px-6 py-3 text-gray-600">29,000.00</td>
                        <td class="px-6 py-3 text-gray-600">2026-01-10</td>

                        <td class="px-6 py-3 text-right space-x-2 flex">
                            <button
                                class="inline-flex px-3 py-1.5 text-sm text-amber-700 border border-amber-200 hover:bg-amber-50 rounded-lg transition">
                                <i class="fa-regular fa-eye mr-1 mt-1"></i> View
                            </button>
                            <button
                                class="px-3 py-1.5 text-sm text-white bg-amber-600 hover:bg-amber-700 rounded-lg transition inline-flex">
                                <i class="fa-solid fa-envelope mr-1 mt-1"></i> Remind
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="flex-1 justify-end py-6">
            <TransparentButton>
                View All
            </TransparentButton>
        </div>
    </div>
</template>