<script setup>
import { ref, computed } from 'vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import LargeCards from '../../Components/Cards/LargeCards.vue';
import VueApexCharts from 'vue3-apexcharts';

// Mock Stats
const stats = ref({
    total_revenue: 4500000,
    occupancy_rate: 95,
    pending_maintenance: 12,
    outstanding_payments: 350000
});

// AI Executive Summary
const aiSummary = {
    healthScore: 92,
    status: 'Excellent',
    summary: "Property performance is exceptional. Revenue is tracking 15% above last year's average, and occupancy is stable at 95%. Maintenance efficiency has improved, though utility costs in Block B are slightly elevated.",
    highlights: [
        { icon: 'fa-arrow-trend-up', text: 'Revenue up 15% YoY', color: 'text-green-600' },
        { icon: 'fa-user-check', text: 'Occupancy stable at 95%', color: 'text-blue-600' },
        { icon: 'fa-bolt', text: 'Utility spike in Block B', color: 'text-amber-600' }
    ]
};

// AI Recommendations
const aiRecommendations = [
    { 
        id: 1, 
        title: 'Optimize Rental Yield', 
        description: 'Occupancy is high (95%). Consider increasing rent by 5-8% for upcoming lease renewals to maximize revenue.', 
        type: 'Financial',
        icon: 'fa-sack-dollar',
        color: 'bg-green-100 text-green-700'
    },
    { 
        id: 2, 
        title: 'Preventive Maintenance', 
        description: 'HVAC systems in Ocean View are due for inspection based on usage patterns. Schedule now to avoid summer breakdowns.', 
        type: 'Maintenance',
        icon: 'fa-wrench',
        color: 'bg-amber-100 text-amber-700'
    },
    { 
        id: 3, 
        title: 'Tenant Retention', 
        description: '3 leases are expiring in March. Send personalized renewal offers to maintaining high retention rates.', 
        type: 'Occupancy',
        icon: 'fa-handshake',
        color: 'bg-blue-100 text-blue-700'
    }
];

// Financial Chart Options
const financeOptions = {
    chart: { type: 'area', toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
    colors: ['#10b981', '#ef4444', '#6366f1'], // Added color for forecast
    fill: { type: 'gradient', gradient: { shadeIntensity: 1, opacityFrom: 0.7, opacityTo: 0.2, stops: [0, 90, 100] } },
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 2, dashArray: [0, 0, 5] }, // Dashed line for forecast
    xaxis: { categories: ['Aug', 'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb (Est)'], axisBorder: { show: false }, axisTicks: { show: false } }, // Added Forecast Month
    yaxis: { show: false },
    grid: { show: false },
    tooltip: { theme: 'light' }
};

const financeSeries = [
    { name: 'Income', data: [850, 920, 880, 950, 1100, 1200, 1250] }, // Added forecast data point
    { name: 'Expenses', data: [350, 400, 380, 420, 450, 500, 480] },   // Added forecast data point
    // { name: 'Forecast', data: [null, null, null, null, null, 1200, 1350] } // Optional: Separate series for clear distinction
];

// Occupancy Chart Options
const occupancyOptions = {
    chart: { type: 'donut', fontFamily: 'Inter, sans-serif' },
    labels: ['Occupied', 'Vacant', 'Maintenance'],
    colors: ['#10b981', '#f59e0b', '#ef4444'],
    legend: { position: 'bottom' },
    dataLabels: { enabled: false },
    plotOptions: { pie: { donut: { size: '75%', labels: { show: true, total: { show: true, label: 'Health Score', color: '#374151', formatter: () => '92/100' } } } } }
};

const occupancySeries = [45, 3, 2];

// Report Categories
const categories = [
    { 
        title: 'Financial Reports', 
        icon: 'fa-file-invoice-dollar', 
        color: 'text-green-600 bg-green-50', 
        items: ['Monthly Rent Roll', 'Expense Summary', 'Profit & Loss Statement', 'Tax Report'] 
    },
    { 
        title: 'Occupancy & Tenants', 
        icon: 'fa-users', 
        color: 'text-blue-600 bg-blue-50', 
        items: ['Tenant Leases Expiry', 'Vacancy Report', 'Tenant Demographics'] 
    },
    { 
        title: 'Maintenance & Utilities', 
        icon: 'fa-wrench', 
        color: 'text-amber-600 bg-amber-50', 
        items: ['Open Maintenance Tickets', 'Utility Consumption Trends', 'Vendor Performance'] 
    }
];
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
                        <li class="text-amber-500">Reports & Analytics</li>
                    </ul>
                    <h1 class="text-3xl font-bold text-gray-800">Smart Analytics</h1>
                </div>
                <!-- Action Buttons -->
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-200 hover:bg-gray-50 shadow-sm transition-all">
                        <i class="fa-solid fa-robot mr-2 text-indigo-500"></i> Ask AI Assistant
                    </button>
                    <button class="px-4 py-2 bg-amber-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-amber-200 hover:bg-amber-600 transition-all">
                        <i class="fa-solid fa-calendar-check mr-2"></i> Schedule Report
                    </button>
                </div>
            </div>

            <!-- AI Executive Summary -->
            <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl p-6 border border-indigo-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-5">
                    <i class="fa-solid fa-brain text-9xl text-indigo-900"></i>
                </div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-white p-2 rounded-lg shadow-sm text-indigo-600">
                            <i class="fa-solid fa-wand-magic-sparkles text-xl"></i>
                        </div>
                        <h2 class="text-xl font-bold text-indigo-900">AI Executive Summary</h2>
                        <span class="px-3 py-1 bg-white/60 text-indigo-700 text-xs font-bold rounded-full border border-indigo-100">
                            Updated just now
                        </span>
                    </div>
                    <p class="text-gray-700 leading-relaxed font-medium mb-6 max-w-4xl">
                        {{ aiSummary.summary }}
                    </p>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div v-for="(highlight, index) in aiSummary.highlights" :key="index" class="flex items-center gap-3 bg-white/80 p-3 rounded-xl border border-indigo-50 shadow-sm backdrop-blur-sm">
                            <i :class="['fa-solid', highlight.icon, highlight.color]"></i>
                            <span class="text-sm font-bold text-gray-700">{{ highlight.text }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Overview -->
            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Financial Overview -->
                <LargeCards class="lg:col-span-2 relative overflow-hidden">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Financial Performance & Forecast</h3>
                            <p class="text-xs text-gray-400 font-medium">Includes AI-generated projection for next month</p>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-green-500"></div>
                                <span class="text-xs font-bold text-gray-500">Income</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 rounded-full bg-red-500"></div>
                                <span class="text-xs font-bold text-gray-500">Expenses</span>
                            </div>
                        </div>
                    </div>
                    <VueApexCharts height="250" :options="financeOptions" :series="financeSeries" />
                </LargeCards>

                <!-- AI Recommendations -->
                <div class="space-y-4">
                    <div v-for="rec in aiRecommendations" :key="rec.id" class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all cursor-pointer group">
                        <div class="flex items-start justify-between mb-2">
                            <div :class="['w-8 h-8 rounded-lg flex items-center justify-center text-sm', rec.color]">
                                <i :class="['fa-solid', rec.icon]"></i>
                            </div>
                            <i class="fa-solid fa-chevron-right text-gray-300 group-hover:text-gray-500 transition-colors text-xs"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm mb-1">{{ rec.title }}</h4>
                        <p class="text-xs text-gray-500 leading-relaxed">{{ rec.description }}</p>
                    </div>
                </div>
            </div>

             <!-- Occupancy Overview -->
             <div class="grid lg:grid-cols-3 gap-6">
                <LargeCards>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Occupancy Status</h3>
                    <VueApexCharts height="250" :options="occupancyOptions" :series="occupancySeries" />
                    <div class="mt-4 text-center">
                        <p class="text-xs font-bold text-green-600 bg-green-50 inline-block px-3 py-1 rounded-full">
                             <i class="fa-solid fa-arrow-trend-up mr-1"></i> Top 5% in Region
                        </p>
                    </div>
                </LargeCards>

                <!-- Report Categories -->
                <div class="lg:col-span-2 grid md:grid-cols-2 gap-6">
                    <LargeCards v-for="category in categories" :key="category.title" class="group hover:border-amber-200 transition-all">
                        <div class="flex items-center gap-3 mb-6">
                            <div :class="['w-10 h-10 rounded-xl flex items-center justify-center text-lg shadow-sm', category.color]">
                                <i :class="['fa-solid', category.icon]"></i>
                            </div>
                            <h3 class="text-lg font-bold text-gray-800">{{ category.title }}</h3>
                        </div>
                        <ul class="space-y-3">
                            <li v-for="item in category.items" :key="item" class="flex items-center justify-between text-sm group/item cursor-pointer hover:bg-gray-50 p-2 rounded-lg -mx-2 transition-all">
                                <span class="font-medium text-gray-600 group-hover/item:text-gray-900">{{ item }}</span>
                                <div class="flex gap-2 opacity-0 group-hover/item:opacity-100 transition-all">
                                    <button class="text-gray-400 hover:text-amber-500"><i class="fa-solid fa-eye"></i></button>
                                    <button class="text-gray-400 hover:text-blue-500"><i class="fa-solid fa-download"></i></button>
                                </div>
                            </li>
                        </ul>
                    </LargeCards>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
