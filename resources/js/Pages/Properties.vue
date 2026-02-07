<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import LargeCards from '../Components/Cards/LargeCards.vue';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import propertyImage from '@/assets/defaultproperty.png';

const searchQuery = ref('');

const properties = ref([
    { 
        id: 1, 
        name: 'Jammi Apartments', 
        location: 'Ruiru, Kenya', 
        units: 50, 
        occupied: 48, 
        image: propertyImage,
        status: 'Healthy',
        statusColor: 'bg-green-100 text-green-700'
    },
    { 
        id: 2, 
        name: 'Clavence Apartments', 
        location: 'Ruiru, Kenya', 
        units: 50, 
        occupied: 42, 
        image: propertyImage,
        status: 'Action Needed',
        statusColor: 'bg-amber-100 text-amber-700'
    },
    { 
        id: 3, 
        name: 'Glory Apartments', 
        location: 'Nairobi, Kenya', 
        units: 50, 
        occupied: 50, 
        image: propertyImage,
        status: 'Excellent',
        statusColor: 'bg-green-100 text-green-700'
    },
    { 
        id: 4, 
        name: 'Sunrise Residency', 
        location: 'Mombasa, Kenya', 
        units: 20, 
        occupied: 15, 
        image: propertyImage,
        status: 'Vacancy Risk',
        statusColor: 'bg-red-100 text-red-700'
    },
     { 
        id: 5, 
        name: 'Highland Heights', 
        location: 'Nakuru, Kenya', 
        units: 30, 
        occupied: 28, 
        image: propertyImage,
        status: 'Healthy',
        statusColor: 'bg-green-100 text-green-700'
    },
]);

const filteredProperties = computed(() => {
    return properties.value.filter(property => 
        property.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        property.location.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const totalUnits = computed(() => properties.value.reduce((sum, p) => sum + p.units, 0));
const totalOccupied = computed(() => properties.value.reduce((sum, p) => sum + p.occupied, 0));
const occupancyRate = computed(() => Math.round((totalOccupied.value / totalUnits.value) * 100));

</script>

<template>
    <DashboardLayout>
        <div class="space-y-6">
            <!-- Header and Actions -->
            <LargeCards>
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-black text-gray-800 tracking-tight">Properties</h1>
                        <p class="text-sm font-medium text-gray-500 mt-1">
                            <Link href="/dashboard" class="hover:text-amber-600 transition-colors">Dashboard</Link> 
                            <span class="mx-2 text-gray-300">/</span>
                            <span class="text-amber-600 font-bold">Properties</span>
                        </p>
                    </div>
                     <button class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-amber-200 transition-all transform hover:-translate-y-0.5 flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i> Add Property
                    </button>
                </div>
            </LargeCards>

             <!-- AI Portfolio Health -->
            <div class="grid md:grid-cols-2 gap-6">
                 <div class="bg-gradient-to-br from-indigo-50 to-blue-50 rounded-2xl p-6 border border-indigo-100 flex items-start gap-4">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 shrink-0">
                         <i class="fa-solid fa-wand-magic-sparkles text-lg"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-indigo-900">Portfolio Health</h3>
                        <p class="text-sm text-indigo-700 mt-1 leading-relaxed">
                            Overall occupancy is at <strong class="text-indigo-900">{{ occupancyRate }}%</strong>. Performance is strong, but <strong class="text-indigo-900">Clavence Apartments</strong> has decreased by 5% in the last month.
                        </p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl p-6 border border-gray-100 flex items-center justify-between shadow-sm">
                     <div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Units Managed</p>
                        <h2 class="text-4xl font-black text-gray-800 mt-2">{{ totalUnits }}</h2>
                     </div>
                     <div class="text-right">
                         <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Occupancy</p>
                        <h2 class="text-4xl font-black text-emerald-600 mt-2">{{ totalOccupied }}</h2>
                     </div>
                </div>
            </div>


            <!-- Properties Grid -->
            <LargeCards>
                <!-- Search and Filters -->
                 <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div class="relative w-full md:w-96">
                        <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" v-model="searchQuery" placeholder="Search properties by name or location..." 
                            class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-amber-500 focus:border-amber-500 transition-shadow shadow-sm" />
                    </div>
                     <div class="flex items-center gap-2">
                         <span class="text-xs font-bold text-gray-400 uppercase mr-2">Sort By:</span>
                         <select class="px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm font-bold text-gray-600 focus:ring-amber-500 focus:border-amber-500">
                             <option>Name (A-Z)</option>
                             <option>Occupancy (High-Low)</option>
                             <option>Units (High-Low)</option>
                         </select>
                     </div>
                </div>

                <div class="grid xl:grid-cols-4 lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-6">
                    <div v-for="property in filteredProperties" :key="property.id" 
                        class="group flex flex-col bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-xl hover:border-amber-100 transition-all duration-300">
                        
                        <!-- Property Image -->
                        <div class="relative h-48 overflow-hidden rounded-t-2xl">
                            <img :src="property.image" alt="Property Image" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-60"></div>
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4">
                                 <span :class="['px-3 py-1 text-xs font-bold rounded-lg shadow-sm', property.statusColor]">
                                    {{ property.status }}
                                </span>
                            </div>

                            <!-- Actions Overlay -->
                             <div class="absolute top-4 right-4 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <button class="w-8 h-8 bg-white/90 backdrop-blur-sm text-gray-600 rounded-lg flex items-center justify-center hover:bg-amber-600 hover:text-white transition-colors shadow-lg">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </button>
                                <button class="w-8 h-8 bg-white/90 backdrop-blur-sm text-red-500 rounded-lg flex items-center justify-center hover:bg-red-600 hover:text-white transition-colors shadow-lg">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </div>

                             <div class="absolute bottom-4 left-4 text-white">
                                <p class="text-xs font-medium opacity-90"><i class="fa-solid fa-location-dot mr-1"></i> {{ property.location }}</p>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="p-5 flex flex-col flex-1">
                            <h3 class="text-lg font-bold text-gray-800 group-hover:text-amber-600 transition-colors mb-4">{{ property.name }}</h3>
                            
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-gray-50 rounded-lg p-3 text-center">
                                    <p class="text-xs text-gray-400 font-bold uppercase">Units</p>
                                    <p class="text-lg font-black text-gray-800">{{ property.units }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3 text-center">
                                     <p class="text-xs text-gray-400 font-bold uppercase">Occupied</p>
                                    <p class="text-lg font-black text-gray-800">{{ property.occupied }}</p>
                                </div>
                            </div>
                            
                            <button class="mt-auto w-full py-3 bg-gray-50 hover:bg-amber-600 hover:text-white text-gray-700 text-sm font-bold rounded-xl transition-all flex items-center justify-center gap-2 group/btn">
                                Manage Property <i class="fa-solid fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-if="filteredProperties.length === 0" class="text-center py-12">
                     <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto text-gray-400 mb-4">
                        <i class="fa-solid fa-building-circle-xmark text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800">No properties found</h3>
                    <p class="text-gray-500 mt-1">Try adjusting your search terms.</p>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>