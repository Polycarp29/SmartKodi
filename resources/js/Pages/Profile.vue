<script setup>
import LargeCards from '../Components/Cards/LargeCards.vue';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import ElevatedButton from '../Layouts/Widgets/ElevatedButton.vue';

</script>

<template>
    <DashboardLayout>
        <div class="py-6 mt-4">
            <ul class="flex flex-row space-x-4">
                <li>
                    <a href=""
                        class="text-gray-500 text-sm hover:text-amber-600 hover:underline font-semibold inline-flex">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="" class="text-gray-500 text-sm hover:text-amber-600 hover:underline font-semibold">Profile
                        ></a>
                </li>
            </ul>

            <h1 class="text-2xl font-bold text-gray-700 py-4">Profile</h1>
        </div>
        <LargeCards>
            <div class="flex min-h-screen bg-gray-50">
                <!-- Sidebar -->
                <aside class="w-64 bg-white border-r border-gray-200 p-6">
                    <nav class="space-y-3">
                        <button
                            class="w-full flex items-center px-4 py-2.5 text-sm space-x-2  font-medium text-white bg-amber-600 rounded-lg hover:bg-amber-700 transition">
                            <i class="fa-solid fa-user mr-2 text-white"></i>
                            Profile
                        </button>

                        <button
                            class="w-full flex items-center px-4 py-2.5 text-sm space-x-2  font-medium text-amber-700 bg-amber-50 border border-amber-100 rounded-lg hover:bg-amber-600 hover:text-white transition">
                            <i class="fa-solid fa-sack-dollar mr-2"></i>
                            Subscriptions
                        </button>

                        <button
                            class="w-full flex items-center px-4 py-2.5 text-sm  space-x-2 font-medium text-amber-700 bg-amber-50 border border-amber-100 rounded-lg hover:bg-amber-600 hover:text-white transition">
                            <i class="fa-solid fa-shield-halved mr-2"></i>
                            Privacy & Security
                        </button>

                        <button
                            class="w-full flex items-center px-4 py-2.5 text-sm space-x-2  font-medium text-amber-700 bg-amber-50 border border-amber-100 rounded-lg hover:bg-amber-600 hover:text-white transition">
                            <i class="fa-solid fa-user-shield mr-2"></i>
                            Roles & Permissions
                        </button>

                        <button
                            class="w-full flex items-center px-4 py-2.5 space-x-2  text-sm font-medium text-amber-700 bg-amber-50 border border-amber-100 rounded-lg hover:bg-amber-600 hover:text-white transition">
                            <i class="fa-solid fa-users mr-2"></i>
                            Users
                        </button>
                    </nav>
                </aside>

                <!-- Main Content -->
                <main class="flex-1 p-8">
                    <div class="bg-white border border-gray-100 rounded-xl shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4">Right Section</h2>
                        <p class="text-gray-600">
                            This area will display the corresponding settings or content
                            based on the selected tab from the sidebar.
                        </p>
                    </div>
                </main>
            </div>



        </LargeCards>
    </DashboardLayout>

</template>