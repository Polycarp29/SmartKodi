<script setup>
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import Header from '../Components/Common/Header.vue';


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
                    <div class="w-full bg-white rounded-xl p-8 shadow-sm">
                        Card 1
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="w-full bg-white rounded-2xl shadow-sm p-8">
                            Card 2
                        </div>
                        <div class="w-full bg-white rounded-2xl shadow-sm p-8">
                            Card 2
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
                    <div class="w-full bg-white rounded-2xl shadow-sm p-8">
                        Large Cards
                    </div>

                    <div class="w-full bg-white rounded-2xl shadow-sm p-8">
                        Large Cards
                    </div>
                </div>
            </section>
        </div>
    </DashboardLayout>

</template>