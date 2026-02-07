<script setup>
import { ref, computed } from 'vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import LargeCards from '../../Components/Cards/LargeCards.vue';
import VueApexCharts from 'vue3-apexcharts';

// Mock Data for Gas Readings/Refills
const readings = ref([
    { id: 1, date: '2026-02-05', type: 'Refill', quantity: '13kg Cylinder', cost: 1400, supplier: 'TotalEnergies', status: 'Paid' },
    { id: 2, date: '2026-01-10', type: 'Refill', quantity: '13kg Cylinder', cost: 1350, supplier: 'TotalEnergies', status: 'Paid' },
    { id: 3, date: '2025-12-15', type: 'Refill', quantity: '13kg Cylinder', cost: 1450, supplier: 'TotalEnergies', status: 'Paid' },
    { id: 4, date: '2025-11-20', type: 'Refill', quantity: '6kg Cylinder', cost: 700, supplier: 'K-Gas', status: 'Paid' },
    { id: 5, date: '2025-10-25', type: 'Refill', quantity: '13kg Cylinder', cost: 1400, supplier: 'TotalEnergies', status: 'Paid' },
    { id: 6, date: '2025-09-30', type: 'Refill', quantity: '13kg Cylinder', cost: 1380, supplier: 'TotalEnergies', status: 'Paid' },
]);

// Chart Options (Monthly Cost Trend)
const consumptionOptions = {
    chart: { type: 'bar', toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
    colors: ['#ef4444'],
    plotOptions: { bar: { borderRadius: 4, columnWidth: '50%' } },
    dataLabels: { enabled: false },
    xaxis: { categories: ['Nov', 'Dec', 'Jan', 'Feb'], axisBorder: { show: false }, axisTicks: { show: false } },
    yaxis: { show: false },
    grid: { show: false },
    tooltip: { theme: 'light' }
};

const consumptionSeries = [{ name: 'Spend (KES)', data: [700, 1450, 1350, 1400] }];

const stats = computed(() => {
    const currentCost = readings.value[0].cost;
    const previousCost = readings.value[1].cost;
    const trend = ((currentCost - previousCost) / previousCost) * 100;
    
    return {
        totalSpend: 1400,
        trend: trend.toFixed(1),
        isIncrease: trend > 0
    };
});

// AI Insights
const aiInsight = computed(() => {
    if (stats.value.isIncrease) {
        return {
            title: "Price Increase Alert",
            message: `Gas refill costs have risen by ${stats.value.trend}% compared to your last refill. Consider checking other suppliers for better rates.`,
            icon: "fa-arrow-trend-up",
            color: "text-red-500",
            bg: "bg-red-50"
        };
    }
    return {
        title: "Optimal Spending",
        message: "Your gas expenses are stable. You are getting good value based on current market rates.",
        icon: "fa-piggy-bank",
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
                        <li class="text-red-500">Gas</li>
                    </ul>
                    <h1 class="text-3xl font-bold text-gray-800">Gas Management</h1>
                </div>
                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-200 hover:bg-gray-50 shadow-sm transition-all">
                        <i class="fa-solid fa-download mr-2 text-gray-400"></i> Export Report
                    </button>
                    <button class="px-4 py-2 bg-red-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-red-200 hover:bg-red-600 transition-all">
                        <i class="fa-solid fa-fire-flame-curved mr-2"></i> Log Refill
                    </button>
                </div>
            </div>

            <!-- Stats & AI Grid -->
            <div class="grid lg:grid-cols-4 gap-6">
                <!-- Summary Card -->
                <div class="flex flex-col justify-between p-6 rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Last Refill Cost</p>
                        <div class="text-3xl font-black text-gray-800">KES {{ stats.totalSpend.toLocaleString() }}</div>
                        <div class="mt-2 flex items-center gap-2">
                            <span :class="['px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider', stats.isIncrease ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600']">
                                <i :class="['fa-solid mr-1', stats.isIncrease ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down']"></i>
                                {{ Math.abs(stats.trend) }}%
                            </span>
                            <span class="text-[10px] text-gray-400 font-bold lowercase">vs last refill</span>
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
                        <i class="fa-solid fa-fire text-9xl text-red-500"></i>
                    </div>
                    <div class="flex items-center justify-between mb-4 relative z-10">
                        <h3 class="text-lg font-bold text-gray-800">Refill Expenditure</h3>
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
                    <h3 class="text-xl font-bold text-gray-800">Refill History</h3>
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 focus-within:ring-2 focus-within:ring-red-100 transition-all">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 text-xs"></i>
                        <input type="text" placeholder="Search history..." class="bg-transparent border-none focus:ring-0 text-xs font-bold text-gray-600 p-0 w-32 md:w-48" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">
                                <th class="pb-4 pl-4">Date</th>
                                <th class="pb-4">Type / Quantity</th>
                                <th class="pb-4">Supplier</th>
                                <th class="pb-4">Cost</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4 text-right pr-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr v-for="reading in paginatedReadings" :key="reading.id" class="group hover:bg-red-50/30 transition-all duration-300">
                                <td class="py-4 pl-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-red-50 text-red-500 flex items-center justify-center text-lg shadow-sm border border-red-100">
                                            <i class="fa-regular fa-calendar"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-800">{{ new Date(reading.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) }}</div>
                                            <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Refill Date</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="text-sm font-bold text-gray-700">{{ reading.quantity }}</div>
                                    <div class="text-[9px] text-gray-400 font-bold uppercase">{{ reading.type }}</div>
                                </td>
                                <td class="py-4">
                                    <span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-600 text-[10px] font-bold">
                                        {{ reading.supplier }}
                                    </span>
                                </td>
                                <td class="py-4 font-black text-xs text-gray-800">
                                    KES {{ reading.cost.toLocaleString() }}
                                </td>
                                <td class="py-4">
                                    <span class="px-2 py-1.5 rounded-lg text-[10px] font-bold uppercase tracking-wider inline-flex items-center gap-1.5 bg-green-50 text-green-700 border border-green-100">
                                        <div class="w-1.5 h-1.5 rounded-full bg-green-500"></div>
                                        {{ reading.status }}
                                    </span>
                                </td>
                                <td class="py-4 pr-4 text-right">
                                    <div class="flex justify-end gap-1">
                                        <button class="w-7 h-7 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all flex items-center justify-center" title="View Details">
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
                                :class="['w-8 h-8 rounded-lg text-xs font-bold transition-all', currentPage === page ? 'bg-red-600 text-white shadow-lg shadow-red-200' : 'text-gray-400 hover:bg-gray-50']"
                            >
                                {{ page }}
                            </button>
                        </div>
                        <button 
                            @click="nextPage" 
                            :disabled="currentPage === totalPages"
                            class="w-8 h-8 rounded-lg flex items-center justify-center text-red-600 border border-red-100 hover:bg-red-50 disabled:opacity-30 disabled:cursor-not-allowed transition-all"
                        >
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
