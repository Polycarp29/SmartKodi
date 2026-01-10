<script setup>
import DashboardLayout from '../Layouts/DashboardLayout.vue';

</script>

<template>
    <DashboardLayout>
        <div class="w-full h-screen">
            <!---Header-->
            <div class="p-6 bg-white rounded-xl shadow-sm">
                <div class="flex items-center justify-between">
                    <!-- Left: Title and subtitle -->
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
                        <p class="text-gray-500 text-sm mt-1">
                            Welcome to <span class="font-semibold text-amber-600">SmartKoddi</span> we’re excited to
                            have you onboard!
                        </p>
                    </div>

                    <!-- Right: Notification + Profile -->
                    <div class="flex items-center space-x-6">
                        <!-- Notifications -->
                        <div class="flex items-center space-x-4">
                            <button class="relative text-gray-600 hover:text-amber-600 transition-colors duration-200"
                                title="Messages">
                                <i class="fa-regular fa-comment text-xl"></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-full">3</span>
                            </button>
                            <button class="relative text-gray-600 hover:text-amber-600 transition-colors duration-200"
                                title="Notifications">
                                <i class="fa-regular fa-bell text-xl"></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-green-500 text-white text-[10px] px-1.5 py-0.5 rounded-full">5</span>
                            </button>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative group">
                            <button
                                class="flex items-center space-x-3 focus:outline-none hover:bg-gray-100 rounded-full p-1 transition">
                                <img src="https://i.pravatar.cc/40" alt="Profile"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-300" />
                                <div class="text-left hidden sm:block">
                                    <p class="text-sm font-semibold text-gray-800">
                                        John Doe
                                    </p>
                                    <p class="text-xs text-gray-500">Admin</p>
                                </div>
                                <i class="fa-solid fa-chevron-down text-xs text-gray-500"></i>
                            </button>

                            <!-- Dropdown Menu -->
                            <div
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 opacity-0 group-hover:opacity-100 group-hover:visible invisible transition-all duration-200 z-20">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <div class="border-t border-gray-100"></div>
                                <a href="#" class="block px-4 py-2 text-sm text-red-500 hover:bg-red-50">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

    <div class="w-full border-t border-amber-100 p-2 bg-gray-50">
        <div class="items-center text-center space-x-4">
            <p class="text-gray-600 text-sm">© 2026 VervioDesk. All rights reserved.
                <span><a href="" class="hover:text-amber-500">Privacy Policy</a></span>
                <span><a href="" class="hover:text-amber-500">Terms of Service</a></span>
                <span><a href="" class="hover:text-amber-500">Cookie Policy</a></span>
            </p>
        </div>
    </div>
</template>