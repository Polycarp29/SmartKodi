<script setup>
import LargeCards from '../Components/Cards/LargeCards.vue';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import propertyImage from '@/assets/defaultproperty.png';






</script>

<template>
    <DashboardLayout>
        <div class="space-y-4">
            <LargeCards>
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold py-2 text-gray-800">
                        Properties
                    </h1>
                    <p class="font-semibold text-gray-500 text-sm "><span class="hover:underline">Dashboard</span> >
                        <span class="text-amber-600 hover:underline">Properties</span>
                    </p>
                </div>
            </LargeCards>

            <!--Another large card-->

            <LargeCards>
                <div class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 grid-cols-1">
                    <!-- Property Card -->
                    <div
                        class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                        <!-- Property Image -->
                        <div class="relative">
                            <img :src="propertyImage"  alt="Property Image"
                                class="w-full h-48 object-contain rounded-t-xl" />

                            <!-- Action Icons -->
                            <div class="absolute top-3 right-3 flex space-x-2">
                                <!-- Edit Button -->
                                <button
                                    class="p-2 bg-white/80 hover:bg-white text-gray-700 rounded-full shadow-sm hover:shadow-md transition"
                                    title="Edit Property">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M16.862 3.487a2.1 2.1 0 0 1 2.97 2.97l-9.547 9.547a2.1 2.1 0 0 1-.885.525l-3.425.856a.525.525 0 0 1-.638-.638l.856-3.425a2.1 2.1 0 0 1 .525-.885l9.547-9.547zM19.5 7.125L17.625 5.25" />
                                    </svg>
                                </button>

                                <!-- Delete Button -->
                                <button
                                    class="p-2 bg-white/80 hover:bg-red-50 text-red-600 rounded-full shadow-sm hover:shadow-md transition"
                                    title="Delete Property">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Property Details -->
                        <div class="p-4 flex flex-col space-y-2">
                            <h3 class="text-lg font-semibold text-gray-800">Jamii Apartment</h3>
                            <p class="text-sm text-gray-500">Nairobi, Kenya</p>
                            <div class="flex items-center justify-between mt-2">
                                <span
                                    class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full font-medium">Available</span>
                            </div>
                        </div>

                        <!-- Footer Action -->
                        <div class="border-t border-gray-100 p-4">
                            <button
                                class="w-full text-center py-2 px-4 text-sm font-medium bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition">
                                Manage Property
                            </button>
                        </div>
                    </div>

                </div>

            </LargeCards>
        </div>

    </DashboardLayout>

</template>