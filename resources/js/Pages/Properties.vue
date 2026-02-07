<script setup>
import LargeCards from '../Components/Cards/LargeCards.vue';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import propertyImage from '@/assets/defaultproperty.png';


const isVacant = false;




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

                <!----Search widget-->
                <div class="flex justify-end">
                    <div class="relative w-64">
                        <input type="text" placeholder="Search properties..."
                            class="w-full pl-10 pr-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent shadow-sm" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" class="w-5 h-5 text-gray-400 absolute left-3 top-2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-4.35-4.35M10 18a8 8 0 100-16 8 8 0 000 16z" />
                        </svg>
                    </div>
                </div>

                <div class="grid lg:grid-cols-4 sm:grid-cols-1 md:grid-cols-2 grid-cols-1 gap-4">
                    <!-- Property Card -->
                    <div
                        class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                        <!-- Property Image -->
                        <div class="relative">
                            <img :src="propertyImage" alt="Property Image"
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
                                <span class="text-xs px-2 py-1 bg-green-100 text-green-700 rounded-full font-medium"> 2
                                    Units Vacant</span>
                                <span
                                    class="text-xs px-2 py-1 bg-amber-100 text-amber-700 rounded-full font-medium border-l-4 border-amber-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-4 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                                    </svg>
                                    New repair request</span>
                            </div>
                        </div>

                        <!-- Footer Action -->
                        <div class="border-t border-gray-100 p-4">
                            <button
                                class="w-full text-center py-2 px-4 text-sm font-medium bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 inline-flex space-x-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                Manage Property
                            </button>
                        </div>
                    </div>


                    <!-- Property Card -->
                    <div
                        class="flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300">
                        <!-- Property Image -->
                        <div class="relative">
                            <img :src="propertyImage" alt="Property Image"
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
                                <span class="text-xs px-2 py-1 bg-gray-100 text-gray-700 rounded-full font-medium">All
                                    Occupied</span>
                                <span
                                    class="text-xs px-2 py-1 bg-amber-100 text-amber-700 rounded-full font-medium border-l-4 border-amber-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-4 inline-flex">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                                    </svg>
                                    4 Tenants have pending rent arrears</span>
                            </div>
                        </div>

                        <!-- Footer Action -->
                        <div class="border-t border-gray-100 p-4">
                            <button
                                class="w-full text-center py-2 px-4 text-sm font-medium bg-amber-600 hover:bg-amber-700 text-white rounded-lg transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-4 inline-flex space-x-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                                Manage Property
                            </button>
                        </div>
                    </div>

                </div>

            </LargeCards>
        </div>

    </DashboardLayout>

</template>