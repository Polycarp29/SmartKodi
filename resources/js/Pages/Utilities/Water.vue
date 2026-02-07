<script setup>
import { ref, computed } from 'vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import LargeCards from '../../Components/Cards/LargeCards.vue';
import VueApexCharts from 'vue3-apexcharts';

// Mock Data for Water Readings
const readings = ref([
    { id: 1, date: '2026-02-01', reading: 1250.5, consumption: 15.2, cost: 2280, status: 'Billed' },
    { id: 2, date: '2026-01-01', reading: 1235.3, consumption: 14.8, cost: 2220, status: 'Paid' },
    { id: 3, date: '2025-12-01', reading: 1220.5, consumption: 16.5, cost: 2475, status: 'Paid' },
    { id: 4, date: '2025-11-01', reading: 1204.0, consumption: 15.0, cost: 2250, status: 'Paid' },
    { id: 5, date: '2025-10-01', reading: 1189.0, consumption: 14.5, cost: 2175, status: 'Paid' },
    { id: 6, date: '2025-09-01', reading: 1174.5, consumption: 15.5, cost: 2325, status: 'Paid' },
]);

// Chart Options
const consumptionOptions = {
    chart: { type: 'area', toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
    colors: ['#0ea5e9'],
    fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.2, stops: [0, 90, 100] } },
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 2 },
    xaxis: { categories: ['Nov', 'Dec', 'Jan', 'Feb'], axisBorder: { show: false }, axisTicks: { show: false } },
    yaxis: { show: false },
    grid: { show: false },
    tooltip: { theme: 'light' }
};

const consumptionSeries = [{ name: 'Consumption (m³)', data: [15.0, 16.5, 14.8, 15.2] }];

const stats = computed(() => {
    const current = readings.value[0];
    const previous = readings.value[1];
    const trend = ((current.consumption - previous.consumption) / previous.consumption) * 100;
    return {
        currentConsumption: current.consumption,
        trend: trend.toFixed(1),
        isIncrease: trend > 0
    };
});

// AI Insights
const aiInsight = computed(() => {
    if (stats.value.isIncrease) {
        return {
            title: "Potential Leak Detected",
            message: `Water usage is ${stats.value.trend}% higher than last month. Check for leaks in the main supply line or irrigation system.`,
            icon: "fa-faucet-drip",
            color: "text-blue-600",
            bg: "bg-blue-50"
        };
    }
    return {
        title: "Water Efficient",
        message: "Great job! Your water consumption is optimized and within the expected range for this season.",
        icon: "fa-hand-holding-droplet",
        color: "text-green-600",
        bg: "bg-green-50"
    };
});

// Pagination State
const currentPage = ref(1);
const itemsPerPage = ref(5);
const totalPages = computed(() => Math.ceil(readings.value.length / itemsPerPage.value));

const paginatedReadings = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return readings.value.slice(start, end);
});

const nextPage = () => { if (currentPage.value < totalPages.value) currentPage.value++; };
const prevPage = () => { if (currentPage.value > 1) currentPage.value--; };
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
                        <li class="text-gray-500">Utilities</li>
                        <li class="text-gray-400">/</li>
                        <li class="text-blue-500">Water</li>
                    </ul>
                    <h1 class="text-3xl font-bold text-gray-800">Water Management</h1>
                </div>
                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-200 hover:bg-gray-50 shadow-sm transition-all">
                        <i class="fa-solid fa-download mr-2 text-gray-400"></i> Export Report
                    </button>
                    <button class="px-4 py-2 bg-blue-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-600 transition-all">
                        <i class="fa-solid fa-plus mr-2"></i> New Reading
                    </button>
                </div>
            </div>

            <!-- Stats & AI Grid -->
            <div class="grid lg:grid-cols-4 gap-6">
                <!-- Summary Card -->
                <div class="flex flex-col justify-between p-6 rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Current Usage</p>
                        <div class="text-3xl font-black text-gray-800">{{ stats.currentConsumption }} <span class="text-sm text-gray-400 font-bold">m³</span></div>
                        <div class="mt-2 flex items-center gap-2">
                            <span :class="['px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider', stats.isIncrease ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600']">
                                <i :class="['fa-solid mr-1', stats.isIncrease ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down']"></i>
                                {{ Math.abs(stats.trend) }}%
                            </span>
                            <span class="text-[10px] text-gray-400 font-bold lowercase">vs last month</span>
                        </div>
                    </div>
                </div>

                <!-- AI Insight Box -->
                <div :class="['lg:col-span-3 rounded-2xl p-4 border border-gray-100 flex items-center gap-4 transition-all', aiInsight.bg]">
                    <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center shrink-0">
                        <i :class="['fa-solid text-xl', aiInsight.icon, aiInsight.color]"></i>
                    </div>
                    <div>
                        <h3 :class="['text-sm font-bold mb-0.5', aiInsight.color]">{{ aiInsight.title }}</h3>
                        <p class="text-gray-600 text-xs font-medium leading-relaxed">{{ aiInsight.message }}</p>
                    </div>
                </div>
            </div>

            <!-- Chart -->
            <div class="grid grid-cols-1">
                <LargeCards class="relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none">
                        <i class="fa-solid fa-droplet text-9xl text-blue-500"></i>
                    </div>
                    <div class="flex items-center justify-between mb-4 relative z-10">
                        <h3 class="text-lg font-bold text-gray-800">Consumption Trend</h3>
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold text-gray-400">Sort by:</span>
                            <select class="bg-gray-50 border-none text-xs font-bold text-gray-500 rounded-lg focus:ring-0 cursor-pointer py-1">
                                <option>Last 6 Months</option>
                                <option>Last Year</option>
                            </select>
                        </div>
                    </div>
                    <VueApexCharts height="250" :options="consumptionOptions" :series="consumptionSeries" class="relative z-10" />
                </LargeCards>
            </div>

            <!-- Readings Table -->
            <LargeCards>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Meter Readings</h3>
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 focus-within:ring-2 focus-within:ring-blue-100 transition-all">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 text-xs"></i>
                        <input type="text" placeholder="Search readings..." class="bg-transparent border-none focus:ring-0 text-xs font-bold text-gray-600 p-0 w-32 md:w-48" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">
                                <th class="pb-4 pl-4">Date / Period</th>
                                <th class="pb-4">Meter Reading</th>
                                <th class="pb-4">Usage</th>
                                <th class="pb-4">Cost</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4 text-right pr-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr v-for="reading in paginatedReadings" :key="reading.id" class="group hover:bg-blue-50/30 transition-all duration-300">
                                <td class="py-4 pl-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center text-lg shadow-sm border border-blue-100">
                                            <i class="fa-regular fa-calendar"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-800">{{ new Date(reading.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) }}</div>
                                            <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Billing Cycle</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="text-xs font-bold text-gray-700">{{ reading.reading.toFixed(1) }}</div>
                                    <div class="text-[9px] text-gray-400 font-bold uppercase">Prev: {{ (reading.reading - reading.consumption).toFixed(1) }}</div>
                                </td>
                                <td class="py-4">
                                    <span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-600 text-[10px] font-bold">
                                        {{ reading.consumption }} m³
                                    </span>
                                </td>
                                <td class="py-4 font-black text-xs text-gray-800">
                                    KES {{ reading.cost.toLocaleString() }}
                                </td>
                                <td class="py-4">
                                    <span :class="['px-2 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider inline-flex items-center gap-1.5', 
                                        reading.status === 'Paid' ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-amber-50 text-amber-700 border border-amber-100']">
                                        <div :class="['w-1.5 h-1.5 rounded-full', reading.status === 'Paid' ? 'bg-green-500' : 'bg-amber-500']"></div>
                                        {{ reading.status }}
                                    </span>
                                </td>
                                <td class="py-4 pr-4 text-right">
                                    <div class="flex justify-end gap-1">
                                        <button class="w-7 h-7 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all flex items-center justify-center" title="View Details">
                                            <i class="fa-solid fa-eye text-xs"></i>
                                        </button>
                                        <button class="w-7 h-7 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-all flex items-center justify-center" title="Download Receipt">
                                            <i class="fa-solid fa-download text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Footer -->
                <div class="flex flex-col md:flex-row items-center justify-between mt-6 pt-6 border-t border-gray-50 gap-4">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Showing {{ (currentPage-1) * itemsPerPage + 1 }} - {{ Math.min(currentPage * itemsPerPage, readings.length) }} of {{ readings.length }} readings</p>
                    <div class="flex gap-2">
                        <button 
                            @click="prevPage" 
                            :disabled="currentPage === 1"
                            class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 border border-gray-100 hover:bg-gray-50 disabled:opacity-30 disabled:cursor-not-allowed transition-all"
                        >
                            <i class="fa-solid fa-chevron-left text-xs"></i>
                        </button>
                        <div class="flex items-center gap-1">
                            <button 
                                v-for="page in totalPages" 
                                :key="page"
                                @click="currentPage = page"
                                :class="['w-8 h-8 rounded-lg text-xs font-bold transition-all', currentPage === page ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'text-gray-400 hover:bg-gray-50']"
                            >
                                {{ page }}
                            </button>
                        </div>
                        <button 
                            @click="nextPage" 
                            :disabled="currentPage === totalPages"
                            class="w-8 h-8 rounded-lg flex items-center justify-center text-blue-600 border border-blue-100 hover:bg-blue-50 disabled:opacity-30 disabled:cursor-not-allowed transition-all"
                        >
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
