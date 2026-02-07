<script setup>
import { ref, computed } from 'vue';
import LargeCards from '../../Components/Cards/LargeCards.vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
import VueApexCharts from 'vue3-apexcharts';

// Mock Data
const invoices = ref([
    { id: 1, tenant: 'John Doe', property: 'Amber Heights', amount: 45000, dueDate: '2026-02-01', status: 'Paid', type: 'Rent' },
    { id: 2, tenant: 'Jane Smith', property: 'Amber Heights', amount: 50000, dueDate: '2026-02-01', status: 'Overdue', type: 'Rent' },
    { id: 3, tenant: 'Alice Johnson', property: 'Sapphire Gardens', amount: 35000, dueDate: '2026-02-05', status: 'Pending', type: 'Rent' },
    { id: 4, tenant: 'Michael Brown', property: 'Ruby Apartments', amount: 5000, dueDate: '2026-02-03', status: 'Overdue', type: 'Utility' },
]);

// Chart Options
const invoiceRatioOptions = {
    chart: { type: 'bar', stacked: true, toolbar: { show: false }, fontFamily: 'Inter, sans-serif' },
    colors: ['#10b981', '#f59e0b', '#ef4444'],
    plotOptions: { bar: { horizontal: true, barHeight: '40%', borderRadius: 8 } },
    dataLabels: { enabled: false },
    xaxis: { categories: ['Total Invoices'], axisBorder: { show: false }, axisTicks: { show: false }, labels: { show: false } },
    yaxis: { labels: { show: false } },
    grid: { show: false },
    legend: { position: 'top', horizontalAlign: 'right', fontWeight: 700, fontSize: '10px' }
};

const invoiceRatioSeries = [
    { name: 'Paid', data: [65] },
    { name: 'Pending', data: [20] },
    { name: 'Overdue', data: [15] }
];

const aiInsight = computed(() => {
    return {
        title: "Intelligent Reconciliation",
        message: "AI found 2 mystery M-Pesa transactions that match overdue amounts for Jane Smith and Michael Brown. Auto-reconcile these 100% matched records?",
        icon: "fa-wand-magic-sparkles",
        color: "text-blue-600",
        bg: "bg-blue-50"
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
                        <li class="text-amber-600">Invoices</li>
                    </ul>
                    <h1 class="text-3xl font-bold text-gray-800">Invoices & Billing</h1>
                </div>
                <div class="flex gap-2">
                    <ElevatedButton class="bg-gray-800 text-white">
                        <i class="fa-solid fa-bolt mr-2 text-amber-500"></i> AI Bulk Generate
                    </ElevatedButton>
                    <ElevatedButton class="bg-amber-600">
                        <i class="fa-solid fa-plus mr-2"></i> New Invoice
                    </ElevatedButton>
                </div>
            </div>

            <!-- Dashboard Stats -->
            <div class="grid lg:grid-cols-4 gap-6">
                <MediumCard class="flex flex-col justify-center border-l-4 border-l-red-500">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Overdue Amount</p>
                    <div class="text-3xl font-extrabold text-red-500">55,000 <span class="text-xs text-gray-400 font-normal">Ksh</span></div>
                    <p class="text-[10px] font-bold text-red-400 mt-2 tracking-tight">Requires Immediate Action</p>
                </MediumCard>

                <div :class="['lg:col-span-3 rounded-3xl p-6 border border-gray-100 flex items-start gap-4', aiInsight.bg]">
                    <div class="p-4 rounded-2xl bg-white shadow-sm shrink-0">
                        <i :class="['fa-solid text-2xl', aiInsight.icon, aiInsight.color]"></i>
                    </div>
                    <div class="flex-1">
                        <h3 :class="['text-lg font-bold mb-1', aiInsight.color]">{{ aiInsight.title }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ aiInsight.message }}</p>
                        <div class="flex gap-2">
                            <button class="px-4 py-2 bg-blue-600 text-white text-xs font-bold rounded-xl shadow-lg shadow-blue-100">Reconcile Now</button>
                            <button class="px-4 py-2 bg-white text-gray-500 text-xs font-bold rounded-xl border border-gray-100 hover:bg-gray-50 transition-colors">Dismiss</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aging & Comparison -->
            <div class="grid lg:grid-cols-3 gap-6">
                <LargeCards class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Invoice Aging Report</h3>
                            <p class="text-xs text-gray-400">Current month status breakdown</p>
                        </div>
                    </div>
                    <VueApexCharts height="120" :options="invoiceRatioOptions" :series="invoiceRatioSeries" />
                    <div class="grid grid-cols-3 gap-4 mt-6 pt-6 border-t border-gray-50">
                        <div v-for="(val, i) in ['Current', '1-30 Days', '30+ Days']" :key="i" class="text-center">
                            <p class="text-[10px] font-bold text-gray-400 uppercase">{{ val }}</p>
                            <p class="text-lg font-bold text-gray-800">{{ [85, 12, 3][i] }}%</p>
                        </div>
                    </div>
                </LargeCards>

                <MediumCard class="bg-amber-600 text-white border-none flex flex-col justify-center">
                    <div class="p-3 bg-white/20 rounded-2xl w-fit mb-4">
                        <i class="fa-solid fa-paper-plane text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold mb-1">Auto-Reminders</h3>
                    <p class="text-xs text-amber-50/80 leading-relaxed mb-6">Schedule smart reminders for upcoming and overdue invoices via SMS/Email.</p>
                    <button class="w-full py-3 bg-white text-amber-600 font-bold text-sm rounded-2xl shadow-xl shadow-amber-900/10">Configure Schedule</button>
                </MediumCard>
            </div>

            <!-- Invoice Registry -->
            <LargeCards class="overflow-hidden">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-800">Invoice Registry</h3>
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 text-xs"></i>
                        <input type="text" placeholder="Search invoices..." class="bg-transparent border-none focus:ring-0 text-xs font-bold text-gray-500 p-0" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">
                                <th class="pb-4">No. / Type</th>
                                <th class="pb-4">Tenant / Property</th>
                                <th class="pb-4">Amount</th>
                                <th class="pb-4">Due Date</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr v-for="inv in invoices" :key="inv.id" class="group hover:bg-amber-50/10 transition-all duration-300">
                                <td class="py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-gray-900 text-amber-500 flex items-center justify-center text-[10px] font-black shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            #{{ 25000 + inv.id }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-800 group-hover:text-amber-600 transition-colors">{{ inv.type }} BILL</div>
                                            <div class="text-[9px] text-gray-400 font-bold uppercase tracking-widest">Digital Invoice</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <div class="text-sm font-bold text-gray-800">{{ inv.tenant }}</div>
                                    <div class="flex items-center gap-1.5 mt-0.5">
                                        <i class="fa-solid fa-building text-[9px] text-gray-400"></i>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-tight">{{ inv.property }}</span>
                                    </div>
                                </td>
                                <td class="py-5 font-black text-gray-800">
                                    <div class="text-sm">{{ inv.amount.toLocaleString() }}</div>
                                    <div class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">KES Outstanding</div>
                                </td>
                                <td class="py-5 text-sm font-bold text-gray-500 italic">{{ inv.dueDate }}</td>
                                <td class="py-5">
                                    <span :class="[
                                        'px-3 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-wider inline-flex items-center gap-1.5 shadow-sm',
                                        inv.status === 'Paid' ? 'bg-green-50 text-green-700' : 
                                        inv.status === 'Overdue' ? 'bg-red-50 text-red-700' : 'bg-amber-50 text-amber-700'
                                    ]">
                                        <div :class="['w-1.5 h-1.5 rounded-full', inv.status === 'Paid' ? 'bg-green-500' : inv.status === 'Overdue' ? 'bg-red-500' : 'bg-amber-500']"></div>
                                        {{ inv.status }}
                                    </span>
                                </td>
                                <td class="py-5 text-right">
                                    <div class="flex justify-end gap-1 px-2">
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 flex items-center justify-center transition-all" title="View Digital Invoice">
                                            <i class="fa-solid fa-eye text-sm"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-all" title="Print PDF">
                                            <i class="fa-solid fa-print text-sm"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-xl text-amber-500 hover:text-amber-700 hover:bg-amber-50 flex items-center justify-center transition-all" title="Manual Reconciliation">
                                            <i class="fa-solid fa-check-double text-sm"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-red-600 hover:bg-red-50 flex items-center justify-center transition-all" title="Void Invoice">
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
