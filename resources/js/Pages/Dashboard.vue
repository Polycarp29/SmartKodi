<script setup>
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import Header from '../Components/Common/Header.vue';
import LargeCards from '../Components/Cards/LargeCards.vue';
import GeneralTable from '../Components/Tables/GeneralTable.vue';



</script>

<template>
    <DashboardLayout>
        <div class="w-full h-screen">
            <Header></Header>

            <!---Cards, Stats and Layout-->
            <section class="py-6">
                <div class="grid lg:grid-cols-3 grid-cols-1 gap-6">
                    <!-- Stats Cards -->
                    <div
                        class="shadow-sm hover:shadow-md transition-shadow duration-200 bg-white rounded-2xl p-6 flex items-center space-x-5">
                        <!-- Icon -->
                        <div
                            class="flex items-center justify-center w-20 h-20 rounded-xl bg-amber-100 border border-amber-200">
                            <i class="fa-solid fa-money-bill-wave text-4xl text-amber-600"></i>
                        </div>

                        <!-- Content -->
                        <div class="flex flex-col justify-between">
                            <h5 class="font-bold text-lg text-amber-700">
                                Unpaid Arrears
                            </h5>
                            <p class="text-sm text-gray-500">
                                Outstanding balance for this month
                            </p>
                            <h2 class="mt-3 font-extrabold text-2xl text-amber-600">
                                Ksh. 1,500,000.00
                            </h2>
                        </div>
                    </div>

                    <div
                        class="shadow-sm hover:shadow-md transition-shadow duration-200 bg-white rounded-2xl p-6 flex items-center space-x-5">
                        <!-- Icon -->
                        <div
                            class="flex items-center justify-center w-20 h-20 rounded-xl bg-amber-100 border border-amber-200">
                            <i class="fa-solid fa-money-bill-wave text-4xl text-amber-600"></i>
                        </div>

                        <!-- Content -->
                        <div class="flex flex-col justify-between">
                            <h5 class="font-bold text-lg text-amber-700">
                                Collected amount
                            </h5>
                            <p class="text-sm text-gray-500">
                                Amount collected this month
                            </p>
                            <h2 class="mt-3 font-extrabold text-2xl text-amber-600">
                                Ksh. 1,500,000.00
                            </h2>
                        </div>
                    </div>

                    <div
                        class="shadow-sm hover:shadow-md transition-shadow duration-200 bg-white rounded-2xl p-6 flex items-center space-x-5">
                        <!-- Icon -->
                        <div
                            class="flex items-center justify-center w-20 h-20 rounded-xl bg-amber-100 border border-amber-200">
                            <i class="fa-solid fa-money-bill-wave text-4xl text-amber-600"></i>
                        </div>

                        <!-- Content -->
                        <div class="flex flex-col justify-between">
                            <h5 class="font-bold text-lg text-amber-700">
                                Collected amount
                            </h5>
                            <p class="text-sm text-gray-500">
                                Amount collected this month
                            </p>
                            <h2 class="mt-3 font-extrabold text-2xl text-amber-600">
                                Ksh. 1,500,000.00
                            </h2>
                        </div>
                    </div>
                </div>
            </section>

            <section class="py-8">
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                    <LargeCards>
                        Revenue Graph
                    </LargeCards>
                    <div class="grid grid-cols-1 gap-4">
                        <LargeCards>Pie Graph</LargeCards>
                        <LargeCards>Activities</LargeCards>
                    </div>
                </div>
            </section>

            <section>
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                    <LargeCards>
                        <GeneralTable></GeneralTable>
                    </LargeCards>

                    <LargeCards>
                        <div class="m-4 relative overflow-x-auto rounded-xl border border-amber-50">
                            <div class="py-4">
                                <h3 class="font-bold text-2xl text-gray-600">
                                    My Properties
                                </h3>
                            </div>
                            <div class="overflow-x-auto rounded-lg border border-gray-100">
                                <table class="min-w-full text-sm text-left">
                                    <thead class="bg-amber-100 text-amber-900 uppercase text-xs tracking-wider">
                                        <tr>
                                            <th class="p-4">
                                                <input type="checkbox"
                                                    class="w-4 h-4 border-gray-300 rounded focus:ring-amber-400" />
                                            </th>
                                            <th class="px-6 py-3 font-semibold">P.Name</th>
                                            <th class="px-6 py-3 font-semibold">Location</th>
                                            <th class="px-6 py-3 font-semibold">Units</th>
                                            <th class="px-6 py-3 font-semibold">Expns</th>
                                            <th class="px-6 py-3 font-semibold text-right">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-100">
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="p-4">
                                                <input type="checkbox"
                                                    class="w-4 h-4 border-gray-300 rounded focus:ring-amber-400" />
                                            </td>
                                            <td class="px-6 py-3 text-gray-700 font-medium">
                                                Jammi Apartments
                                            </td>
                                            <td class="px-6 py-3 text-gray-600">Ruiru,Kenya</td>
                                            <td class="px-6 py-3 text-gray-600">50</td>

                                             <td class="px-6 py-3 text-red-600">500,000.00</td>

                                            <td class="px-6 py-3 text-right space-x-2 flex">
                                                <button
                                                    class="inline-flex px-3 py-1.5 text-sm text-amber-700 border border-amber-200 hover:bg-amber-50 rounded-lg transition">
                                                    <i class="fa-regular fa-eye mr-1 mt-1"></i> View
                                                </button>
                                                <button
                                                    class="px-3 py-1.5 text-sm text-white bg-amber-600 hover:bg-amber-700 rounded-lg transition inline-flex">
                                                   <i class="fa-solid fa-delete-left mr-1 mt-1"></i> Remove
                                                </button>
                                            </td>
                                        </tr>
                                         <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="p-4">
                                                <input type="checkbox"
                                                    class="w-4 h-4 border-gray-300 rounded focus:ring-amber-400" />
                                            </td>
                                            <td class="px-6 py-3 text-gray-700 font-medium">
                                                Clavence Apartments
                                            </td>
                                            <td class="px-6 py-3 text-gray-600">Ruiru,Kenya</td>
                                            <td class="px-6 py-3 text-gray-600">50</td>

                                             <td class="px-6 py-3 text-gray-600">20,000.00</td>

                                            <td class="px-6 py-3 text-right space-x-2 flex">
                                                <button
                                                    class="inline-flex px-3 py-1.5 text-sm text-amber-700 border border-amber-200 hover:bg-amber-50 rounded-lg transition">
                                                    <i class="fa-regular fa-eye mr-1 mt-1"></i> View
                                                </button>
                                                <button
                                                    class="px-3 py-1.5 text-sm text-white bg-amber-600 hover:bg-amber-700 rounded-lg transition inline-flex">
                                                    <i class="fa-solid fa-delete-left mr-1 mt-1"></i> Remove
                                                </button>
                                            </td>
                                        </tr>

                                         <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            <td class="p-4">
                                                <input type="checkbox"
                                                    class="w-4 h-4 border-gray-300 rounded focus:ring-amber-400" />
                                            </td>
                                            <td class="px-6 py-3 text-gray-700 font-medium">
                                                Glory Apartments
                                            </td>
                                            <td class="px-6 py-3 text-gray-600">Nairobi,Kenya</td>
                                            <td class="px-6 py-3 text-gray-600">50</td>

                                             <td class="px-6 py-3 text-green-600">00.00</td>

                                            <td class="px-6 py-3 text-right space-x-2 flex">
                                                <button
                                                    class="inline-flex px-3 py-1.5 text-sm text-amber-700 border border-amber-200 hover:bg-amber-50 rounded-lg transition">
                                                    <i class="fa-regular fa-eye mr-1 mt-1"></i> View
                                                </button>
                                                <button
                                                    class="px-3 py-1.5 text-sm text-white bg-amber-600 hover:bg-amber-700 rounded-lg transition inline-flex">
                                                    <i class="fa-solid fa-delete-left mr-1 mt-1"></i> Remove
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
                    </LargeCards>
                </div>
            </section>
        </div>
    </DashboardLayout>

</template>