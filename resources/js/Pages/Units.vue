<script setup>
import { ref, computed } from 'vue';
import LargeCards from '../Components/Cards/LargeCards.vue';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import MediumCard from '../Components/Cards/MediumCard.vue';
import ElevatedButton from '../Layouts/Widgets/ElevatedButton.vue';

// Mock Data
const properties = ref([
    { id: 1, name: 'Amber Heights', units: 24, icon: 'fa-building' },
    { id: 2, name: 'Sapphire Gardens', units: 18, icon: 'fa-tree-city' },
    { id: 3, name: 'Ruby Apartments', units: 30, icon: 'fa-city' },
    { id: 4, name: 'Emerald Plaza', units: 50, icon: 'fa-building-columns' },
]);

const units = ref([
    { id: 1, name: 'A-101', propertyId: 1, type: 'Two Bedroom', rent: 45000, expenses: 5000, status: 'occupied', note: 'Rent Due' },
    { id: 2, name: 'A-102', propertyId: 1, type: 'One Bedroom', rent: 35000, expenses: 3000, status: 'vacant', note: 'Ready to Let' },
    { id: 3, name: 'B-205', propertyId: 2, type: 'Studio', rent: 25000, expenses: 8000, status: 'maintainance', note: 'Leaking Sink' },
    { id: 4, name: 'G-003', propertyId: 3, type: 'Three Bedroom', rent: 75000, expenses: 10000, status: 'occupied', note: 'Vacation Notice' },
    { id: 5, name: 'E-404', propertyId: 4, type: 'Office Space', rent: 120000, expenses: 25000, status: 'occupied', note: null },
]);

const selectedPropertyId = ref(null);
const propertySearch = ref('');

const filteredProperties = computed(() => {
    if (!propertySearch.value) return properties.value;
    return properties.value.filter(p => 
        p.name.toLowerCase().includes(propertySearch.value.toLowerCase())
    );
});

const filteredUnits = computed(() => {
    if (selectedPropertyId.value === null) return units.value;
    return units.value.filter(u => u.propertyId === selectedPropertyId.value);
});

const calculateMargin = (rent, expenses) => {
    if (rent === 0) return 0;
    return (((rent - expenses) / rent) * 100).toFixed(1);
};

const selectProperty = (id) => {
    selectedPropertyId.value = id;
};

const aiInsights = computed(() => {
    const vacantCount = filteredUnits.value.filter(u => u.status === 'vacant').length;
    const maintenanceCount = filteredUnits.value.filter(u => u.status === 'maintainance').length;
    
    if (maintenanceCount > 0) {
        return {
            title: "Maintenance Alert",
            message: `You have ${maintenanceCount} units under maintenance. Completing these could increase monthly revenue by ${ (maintenanceCount * 30000).toLocaleString() } Ksh.`,
            icon: "fa-screwdriver-wrench",
            color: "text-blue-600",
            bg: "bg-blue-50"
        };
    }
    if (vacantCount > 3) {
        return {
            title: "Occupancy Warning",
            message: "Vacancy rates are above 15% in the selected view. Consider running a promotion or checking market prices.",
            icon: "fa-chart-line-down",
            color: "text-red-600",
            bg: "bg-red-50"
        };
    }
    return {
        title: "Optimal Performance",
        message: "Your units are performing at peak occupancy. AI suggests a 5% rent increase for upcoming lease renewals.",
        icon: "fa-star",
        color: "text-green-600",
        bg: "bg-green-50"
    };
});

</script>

<template>
    <DashboardLayout>
        <div class="space-y-6 pb-12">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mt-6">
                <div>
                    <ul class="flex items-center space-x-2 text-sm font-semibold mb-2">
                        <li><a href="/dashboard" class="text-gray-500 hover:text-amber-600">Dashboard</a></li>
                        <li class="text-gray-400">/</li>
                        <li class="text-amber-600">Units</li>
                    </ul>
                    <h1 class="text-3xl font-bold text-gray-800">Units Management</h1>
                </div>
                <ElevatedButton class="bg-amber-600">
                    <i class="fa-solid fa-plus mr-2"></i> Create New Unit
                </ElevatedButton>
            </div>

            <!-- Property Filter Bar -->
            <section class="bg-white border border-gray-100 rounded-3xl p-4 shadow-sm space-y-4">
                <div class="flex flex-col lg:flex-row lg:items-center gap-4">
                    <div class="relative w-full lg:w-72 shrink-0">
                        <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input 
                            v-model="propertySearch"
                            type="text" 
                            placeholder="Search property..." 
                            class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border-transparent rounded-2xl text-sm focus:bg-white focus:border-amber-400 transition-all"
                        />
                    </div>

                    <div class="flex-1 overflow-hidden">
                        <div class="flex gap-2 overflow-x-auto no-scrollbar pb-1">
                            <button 
                                @click="selectProperty(null)"
                                :class="[
                                    'whitespace-nowrap px-6 py-2.5 rounded-2xl text-sm font-bold transition-all shrink-0',
                                    selectedPropertyId === null ? 'bg-amber-600 text-white shadow-lg shadow-amber-200' : 'bg-gray-50 text-gray-500 hover:bg-gray-100'
                                ]"
                            >
                                All Properties
                            </button>
                            <button 
                                v-for="prop in filteredProperties" 
                                :key="prop.id"
                                @click="selectProperty(prop.id)"
                                :class="[
                                    'whitespace-nowrap px-5 py-2.5 rounded-2xl text-sm font-bold transition-all shrink-0 flex items-center gap-2 border-2',
                                    selectedPropertyId === prop.id ? 'border-amber-600 bg-amber-50 text-amber-700' : 'bg-white border-gray-100 text-gray-600 hover:border-amber-200'
                                ]"
                            >
                                <i :class="['fa-solid text-xs', prop.icon, selectedPropertyId === prop.id ? 'text-amber-600' : 'text-gray-400']"></i>
                                {{ prop.name }}
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Financial & AI Overview -->
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- AI Insights Card -->
                <div :class="['lg:col-span-2 rounded-3xl p-6 border border-gray-100 flex items-start gap-4 transition-all', aiInsights.bg]">
                    <div :class="['p-4 rounded-2xl bg-white shadow-sm', aiInsights.color]">
                        <i :class="['fa-solid text-2xl', aiInsights.icon]"></i>
                    </div>
                    <div class="space-y-1">
                        <h3 :class="['text-lg font-bold', aiInsights.color]">{{ aiInsights.title }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ aiInsights.message }}</p>
                    </div>
                </div>

                <!-- Margin Quick Stats -->
                <MediumCard class="flex flex-col justify-center bg-gray-900 text-white border-none">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Avg. Profit Margin</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-4xl font-extrabold text-amber-500">84.2%</span>
                        <i class="fa-solid fa-arrow-trend-up text-green-400 text-sm"></i>
                    </div>
                    <p class="text-[10px] text-gray-500 mt-2">Across selected property units</p>
                </MediumCard>
            </div>

            <!-- Units Table -->
            <LargeCards class="overflow-hidden">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">
                        Units Inventory <span class="text-gray-400 text-sm font-normal ml-2">({{ filteredUnits.length }} total)</span>
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100">
                                <th class="pb-4">Unit Name</th>
                                <th class="pb-4">Type</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4">Financials</th>
                                <th class="pb-4">Margin</th>
                                <th class="pb-4">Notes</th>
                                <th class="pb-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr v-for="unit in filteredUnits" :key="unit.id" class="group hover:bg-amber-50/10 transition-all duration-300">
                                <td class="py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-gray-900 text-amber-500 flex items-center justify-center text-xs font-black shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            {{ unit.name }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-800 group-hover:text-amber-600 transition-colors">Unit {{ unit.name }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">UID: #{{ unit.id * 1024 }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5 text-sm font-bold text-gray-600 uppercase tracking-tight">{{ unit.type }}</td>
                                <td class="py-5">
                                    <span :class="[
                                        'px-3 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-wider inline-flex items-center gap-1.5 shadow-sm',
                                        unit.status === 'occupied' ? 'bg-green-50 text-green-700' : 
                                        unit.status === 'vacant' ? 'bg-amber-50 text-amber-700' : 'bg-red-50 text-red-700'
                                    ]">
                                        <div :class="['w-1.5 h-1.5 rounded-full', unit.status === 'occupied' ? 'bg-green-500' : unit.status === 'vacant' ? 'bg-amber-500' : 'bg-red-500']"></div>
                                        {{ unit.status }}
                                    </span>
                                </td>
                                <td class="py-5">
                                    <div class="text-sm font-black text-gray-800">{{ unit.rent.toLocaleString() }} <span class="text-[9px] text-gray-400 font-bold uppercase">KES</span></div>
                                    <div class="text-[9px] text-red-400 font-bold tracking-tighter mt-0.5">EST. EXP: {{ unit.expenses.toLocaleString() }}</div>
                                </td>
                                <td class="py-5">
                                    <div class="flex flex-col gap-1.5">
                                        <div class="flex items-center justify-between gap-4">
                                            <span :class="['text-xs font-black', Number(calculateMargin(unit.rent, unit.expenses)) > 80 ? 'text-green-600' : 'text-amber-600']">
                                                {{ calculateMargin(unit.rent, unit.expenses) }}%
                                            </span>
                                        </div>
                                        <div class="w-20 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                            <div 
                                                class="h-full transition-all duration-500 shadow-sm" 
                                                :class="Number(calculateMargin(unit.rent, unit.expenses)) > 80 ? 'bg-green-500' : 'bg-amber-500'"
                                                :style="{ width: calculateMargin(unit.rent, unit.expenses) + '%' }"
                                            ></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <div v-if="unit.note" class="flex items-center gap-2 text-[10px] font-bold px-2 py-1 bg-gray-100 text-gray-500 rounded-lg group-hover:bg-amber-50 group-hover:text-amber-700 transition-colors">
                                        <i class="fa-solid fa-circle-info text-[9px]"></i>
                                        {{ unit.note }}
                                    </div>
                                    <span v-else class="text-gray-300 text-[10px] font-bold uppercase tracking-widest">No Notes</span>
                                </td>
                                <td class="py-5 text-right">
                                    <div class="flex justify-end gap-1 px-2">
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 flex items-center justify-center transition-all" title="View Unit Details">
                                            <i class="fa-solid fa-eye text-sm"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-all" title="Edit Configuration">
                                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-all" title="Delete Unit">
                                            <i class="fa-solid fa-trash-can text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar { display: none; }
.no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
