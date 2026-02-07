<script setup>
import { ref, computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import LargeCards from '../Components/Cards/LargeCards.vue';
import AreaChart from '../Components/Charts/AreaChart.vue';
import PieChart from '../Components/Charts/PieChart.vue';

// Mock Data for Activity Feed
const activities = ref([
    { id: 1, type: 'payment', message: 'Rent payment received from Unit 3B', time: '2 mins ago', amount: '+ KES 45,000', icon: 'fa-sack-dollar', color: 'text-green-600 bg-green-50' },
    { id: 2, type: 'ticket', message: 'New maintenance request: Leaking tap', time: '1 hour ago', priority: 'Medium', icon: 'fa-wrench', color: 'text-amber-600 bg-amber-50' },
    { id: 3, type: 'tenant', message: 'New tenant registered: John Doe', time: '3 hours ago', unit: 'Ocean View 12A', icon: 'fa-user-plus', color: 'text-blue-600 bg-blue-50' },
    { id: 4, type: 'system', message: 'System backup completed successfully', time: '5 hours ago', status: 'Success', icon: 'fa-server', color: 'text-gray-600 bg-gray-50' },
]);

const quickActions = [
    { label: 'Add Property', icon: 'fa-building', color: 'bg-indigo-600 hover:bg-indigo-700', route: '/properties' },
    { label: 'Add Tenant', icon: 'fa-user-plus', color: 'bg-emerald-600 hover:bg-emerald-700', route: '/tenants' },
    { label: 'Record Payment', icon: 'fa-money-bill-wave', color: 'bg-amber-600 hover:bg-amber-700', route: '/financials/rent-payments' },
    { label: 'New Request', icon: 'fa-screwdriver-wrench', color: 'bg-rose-600 hover:bg-rose-700', route: '/maintenance' },
];

const currentDate = new Date().toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });

// Table Logic
const searchQuery = ref('');
const currentPage = ref(1);
const itemsPerPage = 5;

const properties = ref([
    { id: 1, name: 'Jammi Apartments', location: 'Ruiru, Kenya', units: 50, occupied: 49, occupancyRate: 98 },
    { id: 2, name: 'Clavence Apartments', location: 'Ruiru, Kenya', units: 50, occupied: 42, occupancyRate: 84 },
    { id: 3, name: 'Glory Apartments', location: 'Nairobi, Kenya', units: 50, occupied: 49, occupancyRate: 98 },
    { id: 4, name: 'Sunrise Residency', location: 'Mombasa, Kenya', units: 20, occupied: 15, occupancyRate: 75 },
    { id: 5, name: 'Highland Heights', location: 'Nakuru, Kenya', units: 30, occupied: 28, occupancyRate: 93 },
    { id: 6, name: 'Lakeside Villa', location: 'Kisumu, Kenya', units: 10, occupied: 10, occupancyRate: 100 },
]);

const filteredProperties = computed(() => {
    return properties.value.filter(property => 
        property.name.toLowerCase().includes(searchQuery.value.toLowerCase()) ||
        property.location.toLowerCase().includes(searchQuery.value.toLowerCase())
    );
});

const totalPages = computed(() => Math.ceil(filteredProperties.value.length / itemsPerPage));

const paginatedProperties = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage;
    const end = start + itemsPerPage;
    return filteredProperties.value.slice(start, end);
});

</script>

<template>
    <DashboardLayout>
        <div class="space-y-6 pb-12">
            <!-- Intelligent Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mt-6">
                <div>
                     <h1 class="text-2xl font-black text-gray-800 tracking-tight">Dashboard Overview</h1>
                     <p class="text-sm text-gray-500 font-medium mt-1">Here's what's happening today, <span class="text-amber-600 font-bold">{{ currentDate }}</span></p>
                </div>
                
                <!-- Quick Actions -->
                <div class="flex flex-wrap gap-2">
                    <Link v-for="action in quickActions" :key="action.label" :href="action.route" :class="['px-4 py-2 text-white text-sm font-bold rounded-xl shadow-lg shadow-gray-200 transition-all transform hover:-translate-y-0.5 flex items-center gap-2', action.color]">
                        <i :class="['fa-solid', action.icon]"></i> {{ action.label }}
                    </Link>
                </div>
            </div>

            <!-- Stats Row -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Arrears Card -->
                <div class="relative overflow-hidden bg-white p-6 rounded-2xl shadow-sm border border-gray-100 group hover:border-red-100 transition-all">
                    <div class="absolute right-0 top-0 p-6 opacity-5 transform group-hover:scale-110 transition-transform">
                         <i class="fa-solid fa-circle-exclamation text-8xl text-red-600"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-xl bg-red-50 flex items-center justify-center text-red-600 mb-4">
                            <i class="fa-solid fa-money-bill-transfer text-xl"></i>
                        </div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Unpaid Arrears</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1">KES 1.5M</h3>
                        <div class="flex items-center gap-2 mt-4 text-xs font-bold text-red-500 bg-red-50 px-2 py-1 rounded-lg w-fit">
                            <i class="fa-solid fa-arrow-up"></i> 12% vs last month
                        </div>
                    </div>
                </div>

                <!-- Collected Card -->
                <div class="relative overflow-hidden bg-white p-6 rounded-2xl shadow-sm border border-gray-100 group hover:border-emerald-100 transition-all">
                    <div class="absolute right-0 top-0 p-6 opacity-5 transform group-hover:scale-110 transition-transform">
                         <i class="fa-solid fa-coins text-8xl text-emerald-600"></i>
                    </div>
                    <div class="relative z-10">
                         <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 mb-4">
                            <i class="fa-solid fa-sack-dollar text-xl"></i>
                        </div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Collected</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1">KES 3.58M</h3>
                         <div class="flex items-center gap-2 mt-4 text-xs font-bold text-emerald-500 bg-emerald-50 px-2 py-1 rounded-lg w-fit">
                            <i class="fa-solid fa-arrow-up"></i> 8% vs last month
                        </div>
                    </div>
                </div>

                <!-- Properties Card -->
                <div class="relative overflow-hidden bg-white p-6 rounded-2xl shadow-sm border border-gray-100 group hover:border-blue-100 transition-all">
                    <div class="absolute right-0 top-0 p-6 opacity-5 transform group-hover:scale-110 transition-transform">
                         <i class="fa-solid fa-building text-8xl text-blue-600"></i>
                    </div>
                    <div class="relative z-10">
                         <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 mb-4">
                            <i class="fa-regular fa-building text-xl"></i>
                        </div>
                        <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Properties</p>
                        <h3 class="text-3xl font-black text-gray-800 mt-1">5</h3>
                         <div class="flex items-center gap-2 mt-4 text-xs font-bold text-blue-500 bg-blue-50 px-2 py-1 rounded-lg w-fit">
                            <i class="fa-solid fa-plus"></i> 1 New this month
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Charts Section (Left 2/3) -->
                <div class="lg:col-span-2 space-y-6">
                    <LargeCards>
                         <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Revenue Overview</h3>
                            <button class="text-gray-400 hover:text-amber-600 transition-colors"><i class="fa-solid fa-ellipsis"></i></button>
                        </div>
                        <AreaChart />
                    </LargeCards>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <LargeCards>
                             <div class="flex items-center justify-between mb-4">
                                <h3 class="text-lg font-bold text-gray-800">Expenses Breakdown</h3>
                            </div>
                            <PieChart />
                        </LargeCards>

                         <!-- AI Insights -->
                        <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-100">
                            <div class="flex items-center gap-2 mb-4">
                                <i class="fa-solid fa-lightbulb text-amber-500 text-xl"></i>
                                <h3 class="text-lg font-bold text-amber-800">AI Insight</h3>
                            </div>
                            <p class="text-sm font-medium text-amber-900 leading-relaxed">
                                📈 Occupancy is at 92%. You have 3 premium units vacant in <strong>Glory Apartments</strong>. Consider running a "First Month Off" promotion to fill these before the low season.
                            </p>
                             <button class="mt-4 w-full py-2 bg-white text-amber-700 font-bold text-sm rounded-lg border border-amber-200 hover:bg-amber-100 transition-all shadow-sm">
                                View Recommendations
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Feed (Right 1/3) -->
                <div class="space-y-6">
                     <LargeCards class="h-full">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-lg font-bold text-gray-800">Recent Activity</h3>
                            <a href="#" class="text-xs font-bold text-amber-500 hover:text-amber-700">View All</a>
                        </div>
                        <div class="space-y-6">
                            <div v-for="activity in activities" :key="activity.id" class="flex gap-4">
                                <div class="relative">
                                    <div :class="['w-10 h-10 rounded-full flex items-center justify-center z-10 relative', activity.color]">
                                        <i :class="['fa-solid text-sm', activity.icon]"></i>
                                    </div>
                                    <div class="absolute top-10 left-5 w-0.5 h-full bg-gray-100 -ml-[1px] last:hidden"></div>
                                </div>
                                <div class="pb-2">
                                    <p class="text-sm font-bold text-gray-800">{{ activity.message }}</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-xs font-medium text-gray-400">{{ activity.time }}</span>
                                        <span v-if="activity.amount" class="text-xs font-bold text-green-600 bg-green-50 px-1.5 py-0.5 rounded">{{ activity.amount }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </LargeCards>
                </div>
            </div>

            <!-- Enhanced Properties Table -->
            <LargeCards>
                 <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Property Portfolio</h3>
                    <div class="flex items-center gap-2">
                         <div class="relative">
                            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                            <input type="text" v-model="searchQuery" placeholder="Search properties..." class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500 w-full md:w-64" />
                        </div>
                         <button class="px-4 py-2 bg-gray-50 text-gray-600 font-bold text-xs rounded-lg hover:bg-gray-100 transition-all border border-gray-200">
                            Filters <i class="fa-solid fa-filter ml-1"></i>
                        </button>
                    </div>
                </div>
               <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-100">
                                <th class="pb-4 pl-4">Property Name</th>
                                <th class="pb-4">Location</th>
                                <th class="pb-4">Units</th>
                                <th class="pb-4">Status</th> 
                                <th class="pb-4 text-right pr-4">Actions</th>
                            </tr>
                        </thead>
                         <tbody class="divide-y divide-gray-50">
                            <tr v-if="paginatedProperties.length === 0" class="text-center">
                                <td colspan="5" class="py-8 text-sm text-gray-500">No properties found matching your search.</td>
                            </tr>
                            <tr v-for="property in paginatedProperties" :key="property.id" class="group hover:bg-gray-50 transition-colors">
                                <td class="py-4 pl-4 text-sm font-bold text-gray-700">{{ property.name }}</td>
                                <td class="py-4 text-sm text-gray-500">{{ property.location }}</td>
                                <td class="py-4 text-sm font-bold text-gray-700">{{ property.occupied }} / {{ property.units }}</td>
                                <td class="py-4">
                                    <span :class="['px-2 py-1 text-xs font-bold rounded-lg', property.occupancyRate >= 90 ? 'bg-green-50 text-green-600' : 'bg-amber-50 text-amber-600']">
                                        {{ property.occupancyRate }}% Occ.
                                    </span>
                                </td>
                                <td class="py-4 pr-4 text-right flex justify-end gap-2">
                                     <button class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="View Details">
                                        <i class="fa-regular fa-eye"></i>
                                    </button>
                                     <button class="p-2 text-gray-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors" title="Edit Property">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </td>
                            </tr>
                         </tbody>
                    </table>
               </div>
               
               <!-- Pagination Mock -->
               <div class="flex items-center justify-between mt-4 border-t border-gray-50 pt-4" v-if="filteredProperties.length > 0">
                    <p class="text-xs text-gray-400">Showing <span class="font-bold text-gray-700">{{ (currentPage - 1) * itemsPerPage + 1 }}</span> to <span class="font-bold text-gray-700">{{ Math.min(currentPage * itemsPerPage, filteredProperties.length) }}</span> of <span class="font-bold text-gray-700">{{ filteredProperties.length }}</span> properties</p>
                    <div class="flex items-center gap-2">
                        <button :disabled="currentPage === 1" @click="currentPage--" class="px-3 py-1 text-xs font-bold rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">Previous</button>
                        <button :disabled="currentPage === totalPages" @click="currentPage++" class="px-3 py-1 text-xs font-bold rounded-lg border border-gray-200 text-gray-500 hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">Next</button>
                    </div>
               </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>