<script setup>
import { ref, computed } from 'vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import LargeCards from '../../Components/Cards/LargeCards.vue';

// Mock Data for Maintenance Tickets
const tickets = ref([
    { id: 101, title: 'Leaking Faucet in Kitchen', property: 'Sunset Apartments, Unit 3B', priority: 'Low', status: 'Open', date: '2026-02-06', type: 'Plumbing' },
    { id: 102, title: 'AC Unit Not Cooling', property: 'Ocean View, Unit 12A', priority: 'High', status: 'In Progress', date: '2026-02-05', type: 'HVAC' },
    { id: 103, title: 'Main Entrance Light Broken', property: 'Green Valley, Unit 5C', priority: 'Medium', status: 'Pending', date: '2026-02-04', type: 'Electrical' },
    { id: 104, title: 'Water Heater Malfunction', property: 'Sunset Apartments, Unit 1A', priority: 'Critical', status: 'Open', date: '2026-02-03', type: 'Plumbing' },
    { id: 105, title: 'Pest Control Request', property: 'Ocean View, Unit 4B', priority: 'Low', status: 'Resolved', date: '2026-02-01', type: 'General' },
    { id: 106, title: 'Broken Window Latch', property: 'Green Valley, Unit 2B', priority: 'Medium', status: 'Open', date: '2026-01-28', type: 'Carpentry' },
    { id: 107, title: 'Clogged Drain', property: 'Sunset Apartments, Unit 5A', priority: 'High', status: 'Resolved', date: '2026-01-25', type: 'Plumbing' },
]);

// Filters
const search = ref('');
const statusFilter = ref('All');

// Filtered Tickets
const filteredTickets = computed(() => {
    return tickets.value.filter(ticket => {
        const matchesSearch = ticket.title.toLowerCase().includes(search.value.toLowerCase()) || 
                              ticket.property.toLowerCase().includes(search.value.toLowerCase());
        const matchesStatus = statusFilter.value === 'All' || ticket.status === statusFilter.value;
        return matchesSearch && matchesStatus;
    });
});

// Pagination State
const currentPage = ref(1);
const itemsPerPage = ref(5);
const totalPages = computed(() => Math.ceil(filteredTickets.value.length / itemsPerPage.value));

const paginatedTickets = computed(() => {
    const start = (currentPage.value - 1) * itemsPerPage.value;
    const end = start + itemsPerPage.value;
    return filteredTickets.value.slice(start, end);
});

const nextPage = () => { if (currentPage.value < totalPages.value) currentPage.value++; };
const prevPage = () => { if (currentPage.value > 1) currentPage.value--; };

// Priority Color Mapping
const priorityColor = (priority) => {
    switch (priority) {
        case 'Critical': return 'text-red-600 bg-red-50 border-red-100';
        case 'High': return 'text-orange-600 bg-orange-50 border-orange-100';
        case 'Medium': return 'text-amber-600 bg-amber-50 border-amber-100';
        case 'Low': return 'text-blue-600 bg-blue-50 border-blue-100';
        default: return 'text-gray-600 bg-gray-50';
    }
};

// Status Color Mapping
const statusColor = (status) => {
    switch (status) {
        case 'Open': return 'text-blue-600 bg-blue-50';
        case 'In Progress': return 'text-amber-600 bg-amber-50';
        case 'Pending': return 'text-gray-600 bg-gray-50';
        case 'Resolved': return 'text-green-600 bg-green-50';
        default: return 'text-gray-600 bg-gray-50';
    }
};

// Stats
const stats = computed(() => {
    return {
        open: tickets.value.filter(t => t.status === 'Open').length,
        inProgress: tickets.value.filter(t => t.status === 'In Progress').length,
        resolved: tickets.value.filter(t => t.status === 'Resolved').length
    };
});

// AI Insights
const aiInsight = computed(() => {
    const criticalCount = tickets.value.filter(t => t.priority === 'Critical' && t.status !== 'Resolved').length;
    if (criticalCount > 0) {
        return {
            title: "Critical Attention Needed",
            message: `${criticalCount} critical issue(s) require immediate action. Prioritize these to prevent property damage or tenant dissatisfaction.`,
            icon: "fa-triangle-exclamation",
            color: "text-red-500",
            bg: "bg-red-50"
        };
    }
    return {
        title: "Maintenance On Track",
        message: "No critical issues pending. The team is managing the workload efficiently. Consider scheduling preventive maintenance.",
        icon: "fa-circle-check",
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
                        <li class="text-amber-500">Maintenance</li>
                    </ul>
                    <h1 class="text-3xl font-bold text-gray-800">Maintenance Requests</h1>
                </div>
                <!-- Action Buttons -->
                <div class="flex gap-2">
                   <button class="px-4 py-2 bg-white text-gray-700 font-bold text-sm rounded-xl border border-gray-200 hover:bg-gray-50 shadow-sm transition-all">
                        <i class="fa-solid fa-download mr-2 text-gray-400"></i> Export List
                    </button>
                    <button class="px-4 py-2 bg-amber-500 text-white font-bold text-sm rounded-xl shadow-lg shadow-amber-200 hover:bg-amber-600 transition-all">
                        <i class="fa-solid fa-plus mr-2"></i> Report Issue
                    </button>
                </div>
            </div>

            <!-- Stats & AI Grid -->
            <div class="grid lg:grid-cols-4 gap-6">
                <!-- Stats Column -->
                <div class="space-y-4">
                     <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Open Tickets</p>
                            <p class="text-2xl font-black text-blue-600 mt-1">{{ stats.open }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center text-blue-500">
                            <i class="fa-solid fa-clipboard-list text-lg"></i>
                        </div>
                     </div>
                     <div class="bg-white p-4 rounded-xl border border-gray-200 shadow-sm flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">In Progress</p>
                            <p class="text-2xl font-black text-amber-600 mt-1">{{ stats.inProgress }}</p>
                        </div>
                        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center text-amber-500">
                            <i class="fa-solid fa-person-digging text-lg"></i>
                        </div>
                     </div>
                </div>

                <!-- AI Insight Box -->
                <div :class="['lg:col-span-3 rounded-2xl p-6 border border-gray-100 flex items-center gap-6 transition-all', aiInsight.bg]">
                    <div class="w-16 h-16 rounded-2xl bg-white shadow-sm flex items-center justify-center shrink-0">
                        <i :class="['fa-solid text-3xl', aiInsight.icon, aiInsight.color]"></i>
                    </div>
                    <div>
                        <h3 :class="['text-lg font-bold mb-1', aiInsight.color]">{{ aiInsight.title }}</h3>
                        <p class="text-gray-700 text-sm font-medium leading-relaxed max-w-2xl">{{ aiInsight.message }}</p>
                        <div class="flex gap-3 mt-4">
                            <button class="px-3 py-1.5 bg-white text-gray-700 text-xs font-bold rounded-lg border border-gray-200 hover:bg-gray-50 shadow-sm">
                                View Critical Tickets
                            </button>
                            <button class="px-3 py-1.5 bg-white text-gray-700 text-xs font-bold rounded-lg border border-gray-200 hover:bg-gray-50 shadow-sm">
                                Dismiss Prediction
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tickets Table -->
            <LargeCards>
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-2">
                        <button 
                            v-for="status in ['All', 'Open', 'In Progress', 'Resolved']" 
                            :key="status"
                            @click="statusFilter = status; currentPage = 1"
                            :class="['px-3 py-1.5 rounded-lg text-xs font-bold transition-all', 
                                statusFilter === status ? 'bg-amber-500 text-white shadow-md shadow-amber-200' : 'bg-gray-50 text-gray-500 hover:bg-gray-100']"
                        >
                            {{ status }}
                        </button>
                    </div>
                    <div class="flex items-center gap-2 bg-gray-50 px-4 py-2 rounded-xl border border-gray-100 focus-within:ring-2 focus-within:ring-amber-100 transition-all">
                        <i class="fa-solid fa-magnifying-glass text-gray-400 text-xs"></i>
                        <input v-model="search" type="text" placeholder="Search tickets..." class="bg-transparent border-none focus:ring-0 text-xs font-bold text-gray-600 p-0 w-32 md:w-48" />
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-[10px] font-bold text-gray-400 uppercase tracking-widest border-b border-gray-50">
                                <th class="pb-4 pl-4">Ticket</th>
                                <th class="pb-4">Property</th>
                                <th class="pb-4">Priority</th>
                                <th class="pb-4">Status</th>
                                <th class="pb-4 text-right pr-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr v-for="ticket in paginatedTickets" :key="ticket.id" class="group hover:bg-amber-50/30 transition-all duration-300">
                                <td class="py-4 pl-4">
                                    <div class="flex items-start gap-3">
                                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 shrink-0">
                                            <i class="fa-solid fa-wrench text-xs"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-bold text-gray-800">{{ ticket.title }}</div>
                                            <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider mt-0.5">#{{ ticket.id }} • {{ ticket.type }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4">
                                    <div class="text-xs font-bold text-gray-700">{{ ticket.property }}</div>
                                    <div class="text-[10px] text-gray-400 font-bold">{{ new Date(ticket.date).toLocaleDateString() }}</div>
                                </td>
                                <td class="py-4">
                                    <span :class="['px-2 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border', priorityColor(ticket.priority)]">
                                        {{ ticket.priority }}
                                    </span>
                                </td>
                                <td class="py-4">
                                    <span :class="['px-2 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider', statusColor(ticket.status)]">
                                        {{ ticket.status }}
                                    </span>
                                </td>
                                <td class="py-4 pr-4 text-right">
                                    <div class="flex justify-end gap-1">
                                        <button class="w-7 h-7 rounded-lg text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-all flex items-center justify-center" title="Edit Ticket">
                                            <i class="fa-solid fa-pen-to-square text-xs"></i>
                                        </button>
                                        <button class="w-7 h-7 rounded-lg text-gray-400 hover:text-green-600 hover:bg-green-50 transition-all flex items-center justify-center" title="Mark Resolved">
                                            <i class="fa-solid fa-check text-xs"></i>
                                        </button>
                                        <button class="w-7 h-7 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition-all flex items-center justify-center" title="Archive">
                                            <i class="fa-solid fa-box-archive text-xs"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Footer -->
                <div class="flex flex-col md:flex-row items-center justify-between mt-6 pt-6 border-t border-gray-50 gap-4">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Showing {{ (currentPage-1) * itemsPerPage + 1 }} - {{ Math.min(currentPage * itemsPerPage, filteredTickets.length) }} of {{ filteredTickets.length }} tickets</p>
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
                                :class="['w-8 h-8 rounded-lg text-xs font-bold transition-all', currentPage === page ? 'bg-amber-500 text-white shadow-lg shadow-amber-200' : 'text-gray-400 hover:bg-gray-50']"
                            >
                                {{ page }}
                            </button>
                        </div>
                        <button 
                            @click="nextPage" 
                            :disabled="currentPage === totalPages"
                            class="w-8 h-8 rounded-lg flex items-center justify-center text-amber-500 border border-amber-100 hover:bg-amber-50 disabled:opacity-30 disabled:cursor-not-allowed transition-all"
                        >
                            <i class="fa-solid fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
