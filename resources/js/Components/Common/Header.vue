<script setup>

</script>

<template>
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
                        class="flex items-center space-x-3 focus:outline-none hover:bg-amber-100 rounded-full p-1 transition">
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
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-amber-100">Settings</a>
                        <div class="border-t border-gray-100"></div>
                        <a href="#" class="block px-4 py-2 text-sm text-red-500 hover:bg-red-50">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>