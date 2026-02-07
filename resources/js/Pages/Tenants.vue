<script setup>
import { ref, computed } from 'vue';
import LargeCards from '../Components/Cards/LargeCards.vue';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import MediumCard from '../Components/Cards/MediumCard.vue';
import ElevatedButton from '../Layouts/Widgets/ElevatedButton.vue';

// Mock Data
const properties = ref([
    { id: 1, name: 'Amber Heights', address: 'Upper Hill, Nairobi', units: 24, icon: 'fa-building' },
    { id: 2, name: 'Sapphire Gardens', address: 'Kilimani, Nairobi', units: 18, icon: 'fa-tree-city' },
    { id: 3, name: 'Ruby Apartments', address: 'Westlands, Nairobi', units: 30, icon: 'fa-city' },
    { id: 4, name: 'Emerald Plaza', address: 'CBD, Nairobi', units: 50, icon: 'fa-building-columns' },
    { id: 5, name: 'Diamond Suites', address: 'Parklands, Nairobi', units: 12, icon: 'fa-hotel' },
    { id: 6, name: 'Topaz Court', address: 'Lavington, Nairobi', units: 15, icon: 'fa-house-chimney' },
    { id: 7, name: 'Pearl Residency', address: 'Mombasa Road', units: 40, icon: 'fa-building-user' },
]);

const tenants = ref([
    { id: 1, name: 'John Doe', propertyId: 1, propertyName: 'Amber Heights', unit: 'A12', status: 'Active', rent: 45000, balance: 0 },
    { id: 2, name: 'Jane Smith', propertyId: 1, propertyName: 'Amber Heights', unit: 'B04', status: 'Active', rent: 50000, balance: 5000 },
    { id: 3, name: 'Alice Johnson', propertyId: 2, propertyName: 'Sapphire Gardens', unit: 'G01', status: 'Pending', rent: 35000, balance: 0 },
    { id: 4, name: 'Michael Brown', propertyId: 3, propertyName: 'Ruby Apartments', unit: 'R22', status: 'Active', rent: 60000, balance: 0 },
    { id: 5, name: 'Sarah Wilson', propertyId: 2, propertyName: 'Sapphire Gardens', unit: 'G05', status: 'Notice', rent: 38000, balance: 0 },
]);

const selectedPropertyId = ref(null);
const propertySearch = ref('');

const filteredProperties = computed(() => {
    if (!propertySearch.value) return properties.value;
    return properties.value.filter(p =>
        p.name.toLowerCase().includes(propertySearch.value.toLowerCase())
    );
});

const filteredTenants = computed(() => {
    if (selectedPropertyId.value === null) return tenants.value;
    return tenants.value.filter(t => t.propertyId === selectedPropertyId.value);
});

const selectProperty = (id) => {
    selectedPropertyId.value = id;
};
</script>

<template>
    <DashboardLayout>
        <div class="space-y-6 pb-12">
            <!-- Header -->
            <LargeCards>
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mt-6">
                    <div>
                        <ul class="flex items-center space-x-2 text-sm font-semibold mb-2">
                            <li><a href="/dashboard" class="text-gray-500 hover:text-amber-600">Dashboard</a></li>
                            <li class="text-gray-400">/</li>
                            <li class="text-amber-600">Tenants</li>
                        </ul>
                        <h1 class="text-3xl font-bold text-gray-800">Tenant Management</h1>
                    </div>
                    <ElevatedButton class="bg-amber-600">
                        <i class="fa-solid fa-user-plus mr-2"></i> Add New Tenant
                    </ElevatedButton>
                </div>
            </LargeCards>


            <!-- Scalable Property Filter Bar -->
            <section class="bg-white border border-gray-100 rounded-3xl p-4 shadow-sm space-y-4">
                <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                    <!-- Search Field -->
                    <div class="relative w-full lg:w-72 shrink-0">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input v-model="propertySearch" type="text" placeholder="Find property..."
                            class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border-transparent rounded-2xl text-sm focus:bg-white focus:border-amber-400 focus:ring-4 focus:ring-amber-50 transition-all font-medium" />
                    </div>

                    <!-- Horizontal Scrollable Selector -->
                    <div class="flex-1 overflow-hidden relative group">
                        <!-- Fade masks for scroll indication -->
                        <div
                            class="absolute left-0 top-0 bottom-0 w-8 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                        <div
                            class="absolute right-0 top-0 bottom-0 w-8 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>

                        <div class="flex gap-2 overflow-x-auto no-scrollbar pb-2 pt-1 px-1">
                            <!-- All Properties Option -->
                            <button @click="selectProperty(null)" :class="[
                                'whitespace-nowrap px-6 py-2.5 rounded-2xl text-sm font-bold transition-all shrink-0',
                                selectedPropertyId === null
                                    ? 'bg-amber-600 text-white shadow-lg shadow-amber-200'
                                    : 'bg-gray-50 text-gray-500 hover:bg-gray-100'
                            ]">
                                All Properties
                            </button>

                            <!-- Property Options -->
                            <button v-for="prop in filteredProperties" :key="prop.id" @click="selectProperty(prop.id)"
                                :class="[
                                    'whitespace-nowrap px-5 py-2.5 rounded-2xl text-sm font-bold transition-all shrink-0 flex items-center gap-2 border-2',
                                    selectedPropertyId === prop.id
                                        ? 'border-amber-600 bg-amber-50 text-amber-700'
                                        : 'bg-white border-gray-100 text-gray-600 hover:border-amber-200'
                                ]">
                                <i
                                    :class="['fa-solid text-xs', prop.icon, selectedPropertyId === prop.id ? 'text-amber-600' : 'text-gray-400']"></i>
                                {{ prop.name }}
                            </button>

                            <div v-if="filteredProperties.length === 0"
                                class="flex items-center text-sm text-gray-400 italic px-4">
                                No properties found...
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tenants List -->
            <LargeCards class="overflow-hidden">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">
                        {{selectedPropertyId ? properties.find(p => p.id === selectedPropertyId).name : 'Global'}}
                        Tenants
                    </h3>
                    <div
                        class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 focus-within:border-amber-400 transition-colors">
                        <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                        <input type="text" placeholder="Search tenants..."
                            class="bg-transparent border-none focus:ring-0 text-sm w-48 lg:w-64" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr
                                class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100 italic">
                                <th class="pb-4 pt-2">Tenant Name</th>
                                <th class="pb-4 pt-2">Property & Unit</th>
                                <th class="pb-4 pt-2">Status</th>
                                <th class="pb-4 pt-2">Monthly Rent</th>
                                <th class="pb-4 pt-2">Balance</th>
                                <th class="pb-4 pt-2 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr v-for="tenant in filteredTenants" :key="tenant.id"
                                class="group hover:bg-amber-50/20 transition-colors">
                                <td class="py-4 font-bold text-gray-800">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center text-xs font-bold">
                                            {{tenant.name.split(' ').map(n => n[0]).join('')}}
                                        </div>
                                        {{ tenant.name }}
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="text-sm font-semibold text-gray-700">{{ tenant.propertyName }}</div>
                                    <div class="text-xs text-gray-400">Unit: {{ tenant.unit }}</div>
                                </td>
                                <td class="py-4">
                                    <span :class="[
                                        'px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider',
                                        tenant.status === 'Active' ? 'bg-green-100 text-green-700' :
                                            tenant.status === 'Pending' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700'
                                    ]">
                                        {{ tenant.status }}
                                    </span>
                                </td>
                                <td class="py-4 text-sm font-bold text-gray-800">
                                    {{ tenant.rent.toLocaleString() }} <span
                                        class="text-[10px] text-gray-400">Ksh</span>
                                </td>
                                <td class="py-4">
                                    <span
                                        :class="['text-sm font-bold', tenant.balance > 0 ? 'text-red-500' : 'text-gray-400']">
                                        {{ tenant.balance.toLocaleString() }}
                                    </span>
                                </td>
                                <td class="py-4 text-right">
                                    <div
                                        class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button class="p-2 text-gray-400 hover:text-amber-600 transition-colors">
                                            <i class="fa-solid fa-eye text-sm"></i>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-blue-600 transition-colors">
                                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                                        </button>
                                        <button class="p-2 text-gray-400 hover:text-red-500 transition-colors">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Placeholder -->
                <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-50">
                    <p class="text-xs text-gray-500">Showing 5 of 42 tenants</p>
                    <div class="flex gap-2">
                        <button
                            class="px-3 py-1 text-xs font-bold text-gray-400 border border-gray-200 rounded-lg hover:bg-gray-50 disabled:opacity-50"
                            disabled>Previous</button>
                        <button
                            class="px-3 py-1 text-xs font-bold text-amber-600 border border-amber-200 rounded-lg hover:bg-amber-50">Next</button>
                    </div>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
