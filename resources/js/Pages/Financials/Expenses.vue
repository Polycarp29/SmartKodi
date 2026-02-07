<script setup>
import { ref, computed } from 'vue';
import LargeCards from '../../Components/Cards/LargeCards.vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
import VueApexCharts from 'vue3-apexcharts';

// Mock Data
const expenses = ref([
    { id: 1, property: 'Amber Heights', category: 'Maintenance', amount: 15000, date: '2026-02-01', description: 'Plumbing repair for Unit A12' },
    { id: 2, property: 'Sapphire Gardens', category: 'Utilities', amount: 45000, date: '2026-02-02', description: 'Public area electricity' },
    { id: 3, property: 'Ruby Apartments', category: 'Security', amount: 30000, date: '2026-02-03', description: 'Gated security monthly fee' },
    { id: 4, property: 'Amber Heights', category: 'Legal', amount: 10000, date: '2026-02-04', description: 'Lease agreement review' },
]);

// Chart Options
const expenseChartOptions = {
    chart: { type: 'donut', fontFamily: 'Inter, sans-serif' },
    labels: ['Maintenance', 'Utilities', 'Security', 'Legal', 'Tax'],
    colors: ['#f59e0b', '#3b82f6', '#10b981', '#ef4444', '#6366f1'],
    legend: { position: 'bottom' },
    dataLabels: { enabled: false },
    stroke: { width: 0 },
    plotOptions: {
        pie: {
            donut: {
                size: '75%',
                labels: {
                    show: true,
                    total: {
                        show: true,
                        label: 'Total Expenses',
                        formatter: () => '100,000'
                    }
                }
            }
        }
    }
};

const expenseSeries = [35, 25, 20, 15, 5];

const expenseStats = ref({
    totalMonthly: 100000,
    variance: -15.4, // 15.4% less than last month
    topCategory: 'Maintenance'
});

const aiInsight = computed(() => {
    return {
        title: "Smarts Expense Analysis",
        message: "Amber Heights has shown a 20% increase in plumbing costs over the last 3 months. AI suggests a property-wide plumbing audit to prevent catastrophic pipe failures.",
        icon: "fa-triangle-exclamation",
        color: "text-red-600",
        bg: "bg-red-50"
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
                        <li class="text-gray-500">Financials</li>
                        <li class="text-gray-400">/</li>
                        <li class="text-amber-600">Expenses</li>
                    </ul>
                    <h1 class="text-3xl font-bold text-gray-800">Expense Tracking</h1>
                </div>
                <ElevatedButton class="bg-amber-600">
                    <i class="fa-solid fa-plus mr-2"></i> Log New Expense
                </ElevatedButton>
            </div>

            <!-- Stats & AI Analysis -->
            <div class="grid lg:grid-cols-4 gap-6">
                <!-- Total Expenses Card -->
                <div class="flex flex-col justify-center border-l-4 border-l-amber-500 p-4 rounded-lg border border-gray-200 bg-white">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Total Expenses (Feb)</p>
                    <div class="text-3xl font-extrabold text-gray-800">{{ expenseStats.totalMonthly.toLocaleString() }} <span class="text-xs text-gray-400 font-normal">Ksh</span></div>
                    <div class="mt-2 text-xs font-bold text-green-600 flex items-center gap-1">
                        <i class="fa-solid fa-arrow-trend-down"></i>
                        {{ Math.abs(expenseStats.variance) }}% decrease from Jan
                    </div>
                </div>

                <!-- AI Analysis Alert -->
                <div :class="['lg:col-span-3 rounded-3xl p-6 border border-gray-100 flex items-start gap-4', aiInsight.bg]">
                    <div class="p-4 rounded-2xl bg-white shadow-sm shrink-0">
                        <i :class="['fa-solid text-2xl', aiInsight.icon, aiInsight.color]"></i>
                    </div>
                    <div>
                        <h3 :class="['text-lg font-bold mb-1', aiInsight.color]">{{ aiInsight.title }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ aiInsight.message }}</p>
                    </div>
                </div>
            </div>

            <!-- Visual Breakdown -->
            <div class="grid lg:grid-cols-2 gap-6">
                <LargeCards>
                    <h3 class="text-xl font-bold text-gray-800 mb-6 font-primary">Category Breakdown</h3>
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="w-full md:w-1/2">
                            <VueApexCharts height="280" :options="expenseChartOptions" :series="expenseSeries" />
                        </div>
                        <div class="w-full md:w-1/2 space-y-4">
                            <div v-for="(label, i) in expenseChartOptions.labels" :key="i" class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 rounded-full" :style="{ backgroundColor: expenseChartOptions.colors[i] }"></div>
                                    <span class="text-sm font-semibold text-gray-600">{{ label }}</span>
                                </div>
                                <span class="text-sm font-bold text-gray-800">{{ expenseSeries[i] }}%</span>
                            </div>
                        </div>
                    </div>
                </LargeCards>

                <LargeCards>
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Property Spending</h3>
                    <div class="space-y-6">
                        <div v-for="(prop, i) in ['Amber Heights', 'Sapphire Gardens', 'Ruby Apartments']" :key="i" class="space-y-2">
                            <div class="flex justify-between text-xs font-bold uppercase tracking-tight">
                                <span class="text-gray-500">{{ prop }}</span>
                                <span class="text-gray-800">{{ [45, 30, 25][i] }}k Ksh</span>
                            </div>
                            <div class="w-full bg-gray-50 h-2 rounded-full overflow-hidden">
                                <div class="h-full rounded-full bg-gray-800" :style="{ width: [70, 50, 40][i] + '%' }"></div>
                            </div>
                        </div>
                    </div>
                </LargeCards>
            </div>

            <!-- Expense Ledger -->
            <LargeCards class="overflow-hidden">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Expense Ledger</h3>
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 text-xs"></i>
                        <input type="text" placeholder="Search ledger..." class="bg-transparent border-none focus:ring-0 text-xs font-bold text-gray-500 p-0" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">
                                <th class="pb-4">Expense Details</th>
                                <th class="pb-4">Category</th>
                                <th class="pb-4">Amount</th>
                                <th class="pb-4">Date</th>
                                <th class="pb-4">Property</th>
                                <th class="pb-4 text-right">Receipt</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr v-for="exp in expenses" :key="exp.id" class="group hover:bg-amber-50/10 transition-all duration-300">
                                <td class="py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-gray-50 text-gray-400 flex items-center justify-center text-xs font-black shadow-sm group-hover:bg-amber-50 group-hover:text-amber-600 transition-all duration-300">
                                            <i class="fa-solid fa-receipt"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-800 group-hover:text-amber-600 transition-colors">{{ exp.description }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">REF: #{{ exp.id * 882 }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <span class="px-3 py-1.5 bg-gray-100 text-gray-600 rounded-xl text-[10px] font-bold tracking-wider inline-flex items-center gap-1.5 uppercase">
                                        <i :class="['fa-solid text-[9px]', exp.category === 'Maintenance' ? 'fa-screwdriver-wrench' : exp.category === 'Utilities' ? 'fa-bolt' : 'fa-shield-halved']"></i>
                                        {{ exp.category }}
                                    </span>
                                </td>
                                <td class="py-5 font-black text-gray-800">
                                    <div class="text-sm">{{ exp.amount.toLocaleString() }}</div>
                                    <div class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">KES Outflow</div>
                                </td>
                                <td class="py-5 text-sm font-bold text-gray-500 italic">{{ exp.date }}</td>
                                <td class="py-5">
                                    <div class="text-sm font-bold text-gray-700">{{ exp.property }}</div>
                                    <div class="text-[9px] text-gray-400 font-bold uppercase tracking-tight">Main Campus</div>
                                </td>
                                <td class="py-5 text-right">
                                    <div class="flex justify-end gap-1 px-2">
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 flex items-center justify-center transition-all" title="View Expense">
                                            <i class="fa-solid fa-eye text-sm"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-all" title="Edit Record">
                                            <i class="fa-solid fa-pen-to-square text-sm"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-all" title="Remove Record">
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
