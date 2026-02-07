<script setup>
import { ref, computed } from 'vue';
import LargeCards from '../../Components/Cards/LargeCards.vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
import VueApexCharts from 'vue3-apexcharts';

// Mock Data
const stats = ref({
    totalDue: 1250000,
    collected: 980000,
    pending: 270000,
    efficiency: 78.4
});

const recentPayments = ref([
    { id: 1, tenant: 'John Doe', unit: 'A12', apartment: 'Amber Heights', amount: 45000, date: '2026-02-05', method: 'M-Pesa', status: 'Completed' },
    { id: 2, tenant: 'Jane Smith', unit: 'B04', apartment: 'Amber Heights', amount: 50000, date: '2026-02-04', method: 'Bank Transfer', status: 'Completed' },
    { id: 3, tenant: 'Alice Johnson', unit: 'G01', apartment: 'Sapphire Gardens', amount: 35000, date: '2026-02-03', method: 'M-Pesa', status: 'Pending' },
    { id: 4, tenant: 'Michael Brown', unit: 'R22', apartment: 'Ruby Apartments', amount: 60000, date: '2026-02-02', method: 'Cash', status: 'Completed' },
    { id: 5, tenant: 'Sarah Wilson', unit: 'G05', apartment: 'Sapphire Gardens', amount: 38000, date: '2026-02-02', method: 'M-Pesa', status: 'Completed' },
    { id: 6, tenant: 'David Kamau', unit: 'C09', apartment: 'Amber Heights', amount: 42000, date: '2026-02-01', method: 'Bank Transfer', status: 'Completed' },
    { id: 7, tenant: 'Mary Atieno', unit: 'D15', apartment: 'Ruby Apartments', amount: 55000, date: '2026-02-01', method: 'M-Pesa', status: 'Pending' },
    { id: 8, tenant: 'Peter Njoroge', unit: 'B11', apartment: 'Amber Heights', amount: 48000, date: '2026-01-31', method: 'M-Pesa', status: 'Completed' },
    { id: 9, tenant: 'Grace Wambui', unit: 'A05', apartment: 'Sapphire Gardens', amount: 32000, date: '2026-01-30', method: 'Cash', status: 'Completed' },
    { id: 10, tenant: 'Kevin Otieno', unit: 'F20', apartment: 'Ruby Apartments', amount: 70000, date: '2026-01-29', method: 'Bank Transfer', status: 'Completed' },
]);

// Filtering State
const searchQuery = ref('');
const selectedApartment = ref('All Apartments');
const statusFilter = ref('All Status');
const startDate = ref('');
const endDate = ref('');

const apartments = ['All Apartments', 'Amber Heights', 'Sapphire Gardens', 'Ruby Apartments'];

const filteredPayments = computed(() => {
    return recentPayments.value.filter(pay => {
        const matchesSearch = pay.tenant.toLowerCase().includes(searchQuery.value.toLowerCase()) || 
                             pay.unit.toLowerCase().includes(searchQuery.value.toLowerCase());
        const matchesApartment = selectedApartment.value === 'All Apartments' || pay.apartment === selectedApartment.value;
        const matchesStatus = statusFilter.value === 'All Status' || pay.status === statusFilter.value;
        
        let matchesDate = true;
        if (startDate.value && endDate.value) {
            const payDate = new Date(pay.date);
            matchesDate = payDate >= new Date(startDate.value) && payDate <= new Date(endDate.value);
        } else if (startDate.value) {
            matchesDate = new Date(pay.date) >= new Date(startDate.value);
        } else if (endDate.value) {
            matchesDate = new Date(pay.date) <= new Date(endDate.value);
        }

        return matchesSearch && matchesApartment && matchesStatus && matchesDate;
    });
});

// Pagination & Expansion State
const isExpanded = ref(false);
const currentPage = ref(1);
const itemsPerPage = ref(5);

const totalPages = computed(() => Math.ceil(filteredPayments.value.length / itemsPerPage.value));

const paginatedPayments = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return filteredPayments.value.slice(start, end);
});

const nextPage = () => { if (currentPage.value < totalPages.value) currentPage.value++; };
const prevPage = () => { if (currentPage.value > 1) currentPage.value--; };

// Export Functions
const exportCSV = () => {
    const headers = ['Tenant', 'Unit', 'Apartment', 'Amount', 'Date', 'Method', 'Status'];
    const rows = filteredPayments.value.map(p => [
        p.tenant, p.unit, p.apartment, p.amount, p.date, p.method, p.status
    ]);
    
    let csvContent = "data:text/csv;charset=utf-8," 
        + headers.join(",") + "\n"
        + rows.map(e => e.join(",")).join("\n");

    const encodedUri = encodeURI(csvContent);
    const link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", `rent_payments_${new Date().toISOString().split('T')[0]}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
};

const exportPDF = () => {
    window.print();
};

const clearFilters = () => {
    searchQuery.value = '';
    selectedApartment.value = 'All Apartments';
    statusFilter.value = 'All Status';
    startDate.value = '';
    endDate.value = '';
};

// Chart Options
const chartOptions = {
    chart: {
        type: 'area',
        toolbar: { show: false },
        fontFamily: 'Inter, sans-serif'
    },
    colors: ['#f59e0b'],
    dataLabels: { enabled: false },
    stroke: { curve: 'smooth', width: 3 },
    xaxis: {
        categories: ['Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb'],
        axisBorder: { show: false },
        axisTicks: { show: false }
    },
    yaxis: { show: false },
    grid: { show: false },
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.4,
            opacityTo: 0.0,
            stops: [0, 90, 100]
        }
    },
    markers: { size: 4, colors: ['#f59e0b'], strokeColors: '#fff', strokeWidth: 2 }
};

const chartSeries = [{
    name: 'Rent Collected',
    data: [750000, 820000, 790000, 890000, 950000, 980000]
}];

const aiInsight = computed(() => {
    if (stats.value.efficiency < 85) {
        return {
            title: "Collection Efficiency Alert",
            message: "Your current collection rate is 78.4%. SmartKoddi suggests automating SMS reminders for tenants with pending balances of 3+ days.",
            icon: "fa-bolt",
            color: "text-amber-600",
            bg: "bg-amber-50"
        };
    }
    return {
        title: "Healty Collection Flow",
        message: "You are on track! Historical data suggests a 5% increase in timely payments when utilizing M-Pesa STK push integrations.",
        icon: "fa-check-double",
        color: "text-green-600",
        bg: "bg-green-50"
    };
});
</script>

<template>
    <DashboardLayout>
        <div class="space-y-6 pb-12 print:p-0">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mt-6 print:hidden">
                <div>
                    <ul class="flex items-center space-x-2 text-sm font-semibold mb-2">
                        <li><a href="/dashboard" class="text-gray-500 hover:text-amber-600">Dashboard</a></li>
                        <li class="text-gray-400">/</li>
                        <li class="text-gray-500">Financials</li>
                        <li class="text-gray-400">/</li>
                        <li class="text-amber-600">Rent Payments</li>
                    </ul>
                    <h1 class="text-3xl font-bold text-gray-800">Rent Collection</h1>
                </div>
                <div class="flex gap-2">
                    <div class="relative group">
                        <button class="bg-white text-gray-700 border border-gray-200 px-4 py-2 rounded-lg hover:text-white hover:bg-amber-600 transition-all flex items-center gap-2">
                            <i class="fa-solid fa-file-export"></i> Export
                            <i class="fa-solid fa-chevron-down text-[10px]"></i>
                        </button>
                        <!-- Export Dropdown -->
                        <div class="absolute right-0 mt-2 w-40 bg-white border border-gray-100 rounded-xl shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-20">
                            <button @click="exportCSV" class="w-full text-left px-4 py-3 text-sm font-bold text-gray-600 hover:bg-amber-50 hover:text-amber-600 rounded-t-xl transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-file-csv text-green-600"></i> Export CSV
                            </button>
                            <button @click="exportPDF" class="w-full text-left px-4 py-3 text-sm font-bold text-gray-600 hover:bg-amber-50 hover:text-amber-600 rounded-b-xl transition-colors flex items-center gap-2">
                                <i class="fa-solid fa-file-pdf text-red-600"></i> Export PDF
                            </button>
                        </div>
                    </div>
                    <ElevatedButton class="bg-amber-600">
                        <i class="fa-solid fa-plus mr-2"></i> Record Payment
                    </ElevatedButton>
                </div>
            </div>

            <!-- Stats & AI -->
            <div class="grid lg:grid-cols-4 gap-6 print:hidden">
                <div class="bg-white text-gray-600 border-none flex flex-col justify-center rounded-lg p-6 border border-gray-300">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1">Monthly Expected</p>
                    <div class="text-3xl font-extrabold text-amber-500">{{ stats.totalDue.toLocaleString() }} <span class="text-xs text-gray-500 font-normal">Ksh</span></div>
                    <div class="mt-3 w-full bg-gray-800 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-amber-500 h-full" :style="{ width: stats.efficiency + '%' }"></div>
                    </div>
                </div>

                <!-- AI Insight Box -->
                <div :class="['lg:col-span-3 rounded-3xl p-6 border border-gray-100 flex items-start gap-4 transition-all', aiInsight.bg]">
                    <div class="p-4 rounded-2xl bg-white shadow-sm shrink-0">
                        <i :class="['fa-solid text-2xl', aiInsight.icon, aiInsight.color]"></i>
                    </div>
                    <div>
                        <h3 :class="['text-lg font-bold mb-1', aiInsight.color]">{{ aiInsight.title }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">{{ aiInsight.message }}</p>
                    </div>
                </div>
            </div>

            <!-- Visualization Section -->
            <div class="grid lg:grid-cols-3 gap-6 print:hidden">
                <LargeCards class="lg:col-span-2">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Collection Trend</h3>
                            <p class="text-xs text-gray-400">Past 6 months performance</p>
                        </div>
                        <div class="flex items-center gap-2 text-sm font-bold text-green-600 bg-green-50 px-3 py-1 rounded-full">
                            <i class="fa-solid fa-arrow-up"></i>
                            12.4%
                        </div>
                    </div>
                    <VueApexCharts height="300" :options="chartOptions" :series="chartSeries" />
                </LargeCards>

                <div class="space-y-6">
                    <MediumCard class="h-full">
                        <h3 class="font-bold text-gray-800 mb-6">Collection Mix</h3>
                        <div class="space-y-4">
                            <div v-for="(method, index) in ['M-Pesa', 'Bank Transfer', 'Cash']" :key="index" class="space-y-2">
                                <div class="flex justify-between text-xs font-bold uppercase tracking-tight">
                                    <span class="text-gray-500">{{ method }}</span>
                                    <span class="text-gray-800">{{ [65, 25, 10][index] }}%</span>
                                </div>
                                <div class="w-full bg-gray-50 h-2 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full" :class="['bg-amber-500', 'bg-blue-500', 'bg-green-500'][index]" :style="{ width: [65, 25, 10][index] + '%' }"></div>
                                </div>
                            </div>
                        </div>
                    </MediumCard>
                </div>
            </div>

            <!-- Transaction List -->
            <LargeCards :class="['overflow-hidden transition-all duration-500', isExpanded ? 'fixed inset-4 z-50 bg-white m-0 rounded-3xl shadow-2xl' : '']">
                <div class="flex flex-col gap-6 mb-8">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <h3 class="text-xl font-bold text-gray-800">Recent Transactions</h3>
                            <button @click="isExpanded = !isExpanded" class="text-xs font-bold text-amber-600 hover:text-amber-700 underline flex items-center gap-1 print:hidden">
                                <i :class="['fa-solid', isExpanded ? 'fa-compress' : 'fa-expand']"></i>
                                {{ isExpanded ? 'Exit Full View' : 'Full View' }}
                            </button>
                        </div>
                        <button @click="clearFilters" class="text-[10px] font-black uppercase text-gray-400 hover:text-red-500 transition-colors flex items-center gap-1 print:hidden">
                            <i class="fa-solid fa-rotate-right"></i> Reset
                        </button>
                    </div>

                    <!-- Filter Bar -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-3 print:hidden">
                        <!-- Search -->
                        <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 hover:bg-white transition-all focus-within:ring-2 focus-within:ring-amber-200">
                            <i class="fa-solid fa-magnifying-glass text-gray-400 text-xs"></i>
                            <input v-model="searchQuery" type="text" placeholder="Search tenant or unit..." class="bg-transparent border-none focus:ring-0 text-xs font-bold text-gray-700 p-0 w-full" />
                        </div>

                        <!-- Apartment Select -->
                        <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                            <i class="fa-solid fa-building text-gray-400 text-xs"></i>
                            <select v-model="selectedApartment" class="bg-transparent border-none focus:ring-0 text-xs font-bold text-gray-700 p-0 pr-6 w-full cursor-pointer">
                                <option v-for="apt in apartments" :key="apt" :value="apt">{{ apt }}</option>
                            </select>
                        </div>

                        <!-- Status Select -->
                        <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                            <i class="fa-solid fa-circle-check text-gray-400 text-xs"></i>
                            <select v-model="statusFilter" class="bg-transparent border-none focus:ring-0 text-xs font-bold text-gray-700 p-0 pr-6 w-full cursor-pointer">
                                <option>All Status</option>
                                <option>Completed</option>
                                <option>Pending</option>
                            </select>
                        </div>

                        <!-- Date Start -->
                        <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                            <i class="fa-solid fa-calendar-day text-gray-400 text-xs"></i>
                            <input v-model="startDate" type="date" class="bg-transparent border-none focus:ring-0 text-[10px] font-bold text-gray-700 p-0 w-full uppercase" />
                        </div>

                        <!-- Date End -->
                        <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100">
                            <i class="fa-solid fa-calendar-week text-gray-400 text-xs"></i>
                            <input v-model="endDate" type="date" class="bg-transparent border-none focus:ring-0 text-[10px] font-bold text-gray-700 p-0 w-full uppercase" />
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto" :class="isExpanded ? 'max-h-[70vh]' : ''">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">
                                <th class="pb-4">Tenant / Unit</th>
                                <th class="pb-4">Apartment</th>
                                <th class="pb-4">Amount</th>
                                <th class="pb-4">Date</th>
                                <th class="pb-4">Method</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4 text-right print:hidden">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr v-for="pay in (isExpanded ? filteredPayments : paginatedPayments)" :key="pay.id" class="group hover:bg-amber-50/10 transition-all duration-300">
                                <td class="py-5">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center text-xs font-black shadow-sm group-hover:scale-110 transition-transform duration-300">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-800 group-hover:text-amber-600 transition-colors">{{ pay.tenant }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Unit {{ pay.unit }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <div class="text-xs font-bold text-gray-500 uppercase tracking-tight">{{ pay.apartment }}</div>
                                </td>
                                <td class="py-5 font-black text-gray-800">
                                    <div class="text-sm">{{ pay.amount.toLocaleString() }}</div>
                                    <div class="text-[9px] text-gray-400 font-bold uppercase tracking-tighter">KES Total</div>
                                </td>
                                <td class="py-5">
                                    <div class="text-sm font-bold text-gray-600 italic">{{ pay.date || 'NOT SET' }}</div>
                                </td>
                                <td class="py-5">
                                    <div class="flex items-center gap-2 group/method">
                                        <div class="w-7 h-7 rounded-lg bg-gray-50 flex items-center justify-center text-gray-400 group-hover/method:bg-amber-50 group-hover/method:text-amber-600 transition-colors">
                                            <i :class="['fa-solid text-[10px]', pay.method === 'M-Pesa' ? 'fa-mobile-screen-button' : 'fa-building-columns']"></i>
                                        </div>
                                        <span class="text-xs font-bold text-gray-500 uppercase tracking-tight">{{ pay.method || 'Manual' }}</span>
                                    </div>
                                </td>
                                <td class="py-5">
                                    <span :class="[
                                        'px-3 py-1.5 rounded-xl text-[10px] font-bold uppercase tracking-wider inline-flex items-center gap-1.5 shadow-sm',
                                        pay.status === 'Completed' ? 'bg-green-50 text-green-700' : 'bg-amber-50 text-amber-700'
                                    ]">
                                        <div :class="['w-1.5 h-1.5 rounded-full', pay.status === 'Completed' ? 'bg-green-500' : 'bg-amber-500']"></div>
                                        {{ pay.status }}
                                    </span>
                                </td>
                                <td class="py-5 text-right print:hidden">
                                    <div class="flex justify-end gap-1 px-2">
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-amber-600 hover:bg-amber-50 flex items-center justify-center transition-all" title="View Transaction">
                                            <i class="fa-solid fa-eye text-sm"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-xl text-gray-400 hover:text-blue-600 hover:bg-blue-50 flex items-center justify-center transition-all" title="Print Receipt">
                                            <i class="fa-solid fa-print text-sm"></i>
                                        </button>
                                        <button class="w-8 h-8 rounded-xl text-amber-500 hover:text-amber-700 hover:bg-amber-50 flex items-center justify-center transition-all" title="Smart Reconcile">
                                            <i class="fa-solid fa-wand-magic-sparkles text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Empty State -->
                <div v-if="filteredPayments.length === 0" class="py-20 text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center mx-auto mb-4 text-gray-300">
                        <i class="fa-solid fa-filter-circle-xmark text-4xl"></i>
                    </div>
                    <h4 class="text-lg font-bold text-gray-800">No transactions found</h4>
                    <p class="text-sm text-gray-400">Try adjusting your filters or search query.</p>
                </div>

                <!-- Pagination Footer -->
                <div v-if="!isExpanded && filteredPayments.length > 0" class="flex flex-col md:flex-row items-center justify-between mt-8 pt-6 border-t border-gray-50 print:hidden gap-4">
                    <p class="text-xs text-gray-500 font-bold">Showing {{ (currentPage-1) * itemsPerPage + 1 }} - {{ Math.min(currentPage * itemsPerPage, filteredPayments.length) }} of {{ filteredPayments.length }} transactions</p>
                    <div class="flex gap-2">
                        <button 
                            @click="prevPage" 
                            :disabled="currentPage === 1"
                            class="px-4 py-2 text-xs font-bold text-gray-400 border border-gray-200 rounded-xl hover:bg-gray-50 disabled:opacity-30 disabled:cursor-not-allowed transition-all"
                        >
                            <i class="fa-solid fa-chevron-left mr-1"></i> Prev
                        </button>
                        <div class="flex items-center gap-1">
                            <button 
                                v-for="page in totalPages" 
                                :key="page"
                                @click="currentPage = page"
                                :class="['w-8 h-8 rounded-xl text-xs font-bold transition-all', currentPage === page ? 'bg-amber-600 text-white shadow-lg shadow-amber-200' : 'text-gray-400 hover:bg-gray-50']"
                            >
                                {{ page }}
                            </button>
                        </div>
                        <button 
                            @click="nextPage" 
                            :disabled="currentPage === totalPages"
                            class="px-4 py-2 text-xs font-bold text-amber-600 border border-amber-200 rounded-xl hover:bg-amber-50 disabled:opacity-30 disabled:cursor-not-allowed transition-all"
                        >
                            Next <i class="fa-solid fa-chevron-right ml-1"></i>
                        </button>
                    </div>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>

<style scoped>
:deep(.apexcharts-toolbar) { display: none !important; }

@media print {
    body { background: white; }
    .print\:hidden { display: none !important; }
}
</style>
