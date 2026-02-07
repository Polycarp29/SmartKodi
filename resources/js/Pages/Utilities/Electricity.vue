<script setup>
import { ref, computed } from 'vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import LargeCards from '../../Components/Cards/LargeCards.vue';
import VueApexCharts from 'vue3-apexcharts';

// Mock Data for Electricity Readings
const readings = ref([
    { id: 1, date: '2026-02-01', reading: 4500.5, consumption: 156.2, cost: 3500, status: 'Billed' },
    { id: 2, date: '2026-01-01', reading: 4344.3, consumption: 148.8, cost: 3200, status: 'Paid' },
    { id: 3, date: '2025-12-01', reading: 4195.5, consumption: 165.5, cost: 3800, status: 'Paid' },
    { id: 4, date: '2025-11-01', reading: 4030.0, consumption: 150.0, cost: 3100, status: 'Paid' },
]);

// Chart Options
const consumptionOptions = {
    chart: { type: 'area', toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
    colors: ['#f59e0b'],
    fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.2, stops: [0, 90, 100] } },
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 2 },
    xaxis: { categories: ['Nov', 'Dec', 'Jan', 'Feb'], axisBorder: { show: false }, axisTicks: { show: false } },
    yaxis: { show: false },
    grid: { show: false },
    tooltip: { theme: 'light' }
};

const consumptionSeries = [{ name: 'Consumption (kWh)', data: [150.0, 165.5, 148.8, 156.2] }];

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
                        <li class="text-amber-500">Electricity</li>
                    </ul>
                    <h1 class="text-3xl font-bold text-gray-800">Electricity Management</h1>
                </div>
                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-200 hover:bg-gray-50 shadow-sm transition-all">
                        <i class="fa-solid fa-download mr-2 text-gray-400"></i> Export Report
                    </button>
                    <button class="px-4 py-2 bg-amber-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-amber-200 hover:bg-amber-600 transition-all">
                        <i class="fa-solid fa-plus mr-2"></i> Purchase Tokens
                    </button>
                </div>
            </div>

            <!-- Stats & Chart -->
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Summary Card -->
                <MediumCard class="flex flex-col justify-between border-l-4 border-l-amber-500">
                    <div>
                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Current Usage</p>
                        <div class="text-4xl font-black text-gray-800">{{ stats.currentConsumption }} <span class="text-lg text-gray-400 font-bold">kWh</span></div>
                        <div class="mt-2 flex items-center gap-2">
                            <span :class="['px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider', stats.isIncrease ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600']">
                                <i :class="['fa-solid mr-1', stats.isIncrease ? 'fa-arrow-trend-up' : 'fa-arrow-trend-down']"></i>
                                {{ Math.abs(stats.trend) }}%
                            </span>
                            <span class="text-xs text-gray-400 font-medium">vs last month</span>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-50">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-gray-500">Est. Cost</span>
                            <span class="text-lg font-black text-gray-800">KES {{ readings[0].cost.toLocaleString() }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-amber-500 h-full rounded-full" style="width: 65%"></div>
                        </div>
                    </div>
                </MediumCard>

                <!-- Chart -->
                <LargeCards class="lg:col-span-2 relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-6 opacity-10 pointer-events-none">
                        <i class="fa-solid fa-bolt text-9xl text-amber-500"></i>
                    </div>
                    <div class="flex items-center justify-between mb-4 relative z-10">
                        <h3 class="text-lg font-bold text-gray-800">Consumption Trend</h3>
                        <select class="bg-gray-50 border-none text-xs font-bold text-gray-500 rounded-lg focus:ring-0 cursor-pointer">
                            <option>Last 6 Months</option>
                            <option>Last Year</option>
                        </select>
                    </div>
                    <VueApexCharts height="250" :options="consumptionOptions" :series="consumptionSeries" class="relative z-10" />
                </LargeCards>
            </div>

            <!-- Readings Table -->
            <LargeCards>
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Meter Readings & Tokens</h3>
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 focus-within:ring-2 focus-within:ring-amber-100 transition-all">
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
                            <tr v-for="reading in readings" :key="reading.id" class="group hover:bg-amber-50/30 transition-all duration-300">
                                <td class="py-4 pl-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-lg shadow-sm border border-amber-100">
                                            <i class="fa-regular fa-calendar"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-800">{{ new Date(reading.date).toLocaleDateString('en-US', { month: 'long', year: 'numeric' }) }}</div>
                                            <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Billing Cycle</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="text-sm font-bold text-gray-700">{{ reading.reading.toFixed(1) }}</div>
                                    <div class="text-[9px] text-gray-400 font-bold uppercase">Previous: {{ (reading.reading - reading.consumption).toFixed(1) }}</div>
                                </td>
                                <td class="py-4">
                                    <span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-600 text-xs font-bold">
                                        {{ reading.consumption }} kWh
                                    </span>
                                </td>
                                <td class="py-4 font-black text-gray-800">
                                    KES {{ reading.cost.toLocaleString() }}
                                </td>
                                <td class="py-4">
                                    <span :class="['px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider inline-flex items-center gap-1.5', 
                                        reading.status === 'Paid' ? 'bg-green-50 text-green-700 border border-green-100' : 'bg-amber-50 text-amber-700 border border-amber-100']">
                                        <div :class="['w-1.5 h-1.5 rounded-full', reading.status === 'Paid' ? 'bg-green-500' : 'bg-amber-500']"></div>
                                        {{ reading.status }}
                                    </span>
                                </td>
                                <td class="py-4 pr-4 text-right">
                                    <button class="w-8 h-8 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-all flex items-center justify-center">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
