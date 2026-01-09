<script setup>
import { ref } from "vue";
import {
  ChevronLeft,
  ChevronRight
} from 'lucide-vue-next'

// Dropdown toggles
const openMenu = ref({
    financial: false,
    utilities: false,
    maintenance: false,
});


const stats = ref({
    properties: 8,
    units: 24,
    tenants: 17,
    utilities: 5,
    maintenancePending: 3,
});

const props = defineProps({
    collapsed: Boolean
})
</script>

<template>
    <div class="min-h-screen bg-gray-100 flex">
        <!-- Sidebar -->
        <aside id="sidebar" :class="[
            'fixed left-0 top-0 h-screen bg-white border-r border-gray-200 transition-all duration-300 z-40',
            collapsed ? 'w-20' : 'w-64'
        ]" aria-label="Sidebar">
            <div class="h-full px-4 py-6 overflow-y-auto">
                <!-- Brand -->
                <div class="border border-amber-200 p-4 rounded-2xl text-center">
                    <h1 class="font-extrabold text-2xl text-amber-500 tracking-wide">
                        SmartKoddi
                    </h1>
                    <p class="text-xs text-gray-500 mt-1">Property Management Suite</p>
                    <!-- <button @click="emit('toggle')"
                        class="p-2 rounded-lg hover:bg-gray-800 transition-colors text-gray-400 hover:text-white"
                        :class="collapsed && 'mx-auto'">
                        <ChevronLeft v-if="!collapsed" :size="18" />
                        <ChevronRight v-else :size="18" />
                    </button> -->
                </div>

                <!-- Navigation -->
                <nav class="mt-6 space-y-4 text-gray-700 font-medium">
                    <!-- Dashboard -->
                    <a href="#"
                        class="flex items-center justify-between gap-3 px-3 py-2 rounded-md font-semibold hover:bg-amber-50 hover:text-amber-600 hover:border border-amber-200 transition-all duration-300">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-gauge-high"></i>
                            Dashboard
                        </span>
                    </a>

                    <!-- Properties -->
                    <a href="#"
                        class="flex items-center justify-between gap-3 px-3 py-2 rounded-md font-semibold hover:bg-amber-50 hover:text-amber-600 hover:border border-amber-200 transition-all duration-300">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-building"></i>
                            Properties
                        </span>
                        <span class="bg-amber-100 text-amber-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                            {{ stats.properties }}
                        </span>
                    </a>

                    <!-- Units -->
                    <a href="#"
                        class="flex items-center justify-between gap-3 px-3 py-2 rounded-md font-semibold hover:bg-amber-50 hover:text-amber-600 hover:border border-amber-200 transition-all duration-300">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-house-user"></i>
                            Units
                        </span>
                        <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                            {{ stats.units }}
                        </span>
                    </a>

                    <!-- Tenants -->
                    <a href="#"
                        class="flex items-center justify-between gap-3 px-3 py-2 rounded-md font-semibold hover:bg-amber-50 hover:text-amber-600 hover:border border-amber-200 transition-all duration-300">
                        <span class="flex items-center gap-3">
                            <i class="fa-solid fa-users"></i>
                            Tenants
                        </span>
                        <span class="bg-green-100 text-green-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                            {{ stats.tenants }}
                        </span>
                    </a>

                    <!-- Financials -->
                    <div>
                        <button @click="openMenu.financial = !openMenu.financial"
                            class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-amber-50 hover:text-amber-600 hover:border border-amber-200 font-semibold transition-all duration-300">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-sack-dollar"></i>
                                Financials
                            </span>
                            <i class="fa-solid fa-caret-down transition-transform duration-300"
                                :class="{ 'rotate-180': openMenu.financial }"></i>
                        </button>

                        <transition name="fade">
                            <div v-show="openMenu.financial" class="pl-9 space-y-1 mt-1 text-sm text-gray-600">
                                <a href="#" class="flex items-center gap-2 py-1.5 hover:text-amber-600">
                                    <i class="fa-regular fa-file-invoice-dollar"></i>
                                    Rent Payments
                                </a>
                                <a href="#" class="flex items-center gap-2 py-1.5 hover:text-amber-600">
                                    <i class="fa-solid fa-chart-line"></i>
                                    Income & Expenses
                                </a>
                                <a href="#" class="flex items-center gap-2 py-1.5 hover:text-amber-600">
                                    <i class="fa-solid fa-wallet"></i>
                                    Invoices
                                </a>
                            </div>
                        </transition>
                    </div>

                    <!-- Utilities -->
                    <div>
                        <button @click="openMenu.utilities = !openMenu.utilities"
                            class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-amber-50 hover:text-amber-600 hover:border border-amber-200 font-semibold transition-all duration-300">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-lightbulb"></i>
                                Utilities
                            </span>
                            <span class="bg-purple-100 text-purple-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                                {{ stats.utilities }}
                            </span>
                            <i class="fa-solid fa-caret-down transition-transform duration-300"
                                :class="{ 'rotate-180': openMenu.utilities }"></i>
                        </button>

                        <transition name="fade">
                            <div v-show="openMenu.utilities" class="pl-9 space-y-1 mt-1 text-sm text-gray-600">
                                <a href="#" class="flex items-center gap-2 py-1.5 hover:text-amber-600">
                                    <i class="fa-solid fa-droplet"></i> Water
                                </a>
                                <a href="#" class="flex items-center gap-2 py-1.5 hover:text-amber-600">
                                    <i class="fa-solid fa-bolt"></i> Electricity
                                </a>
                                <a href="#" class="flex items-center gap-2 py-1.5 hover:text-amber-600">
                                    <i class="fa-solid fa-fire"></i> Gas
                                </a>
                            </div>
                        </transition>
                    </div>

                    <!-- Maintenance -->
                    <div>
                        <button @click="openMenu.maintenance = !openMenu.maintenance"
                            class="flex items-center justify-between w-full px-3 py-2 rounded-md hover:bg-amber-50 hover:text-amber-600 hover:border border-amber-200 font-semibold transition-all duration-300">
                            <span class="flex items-center gap-3">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                Maintenance
                            </span>
                            <span class="bg-red-100 text-red-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                                {{ stats.maintenancePending }}
                            </span>
                            <i class="fa-solid fa-caret-down transition-transform duration-300"
                                :class="{ 'rotate-180': openMenu.maintenance }"></i>
                        </button>

                        <transition name="fade">
                            <div v-show="openMenu.maintenance" class="pl-9 space-y-1 mt-1 text-sm text-gray-600">
                                <a href="#" class="flex items-center gap-2 py-1.5 hover:text-amber-600">
                                    <i class="fa-solid fa-clipboard-list"></i>
                                    Requests
                                </a>
                                <a href="#" class="flex items-center gap-2 py-1.5 hover:text-amber-600">
                                    <i class="fa-solid fa-person-digging"></i>
                                    Work Orders
                                </a>
                            </div>
                        </transition>
                    </div>

                    <!-- Reports -->
                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-amber-50 hover:text-amber-600 hover:border border-amber-200 font-semibold transition-all duration-300">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Reports</span>
                    </a>

                    <!-- Settings -->
                    <a href="#"
                        class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-amber-50 hover:text-amber-600 hover:border border-amber-200 font-semibold transition-all duration-300">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </a>
                </nav>
                <button
                    class="mt-6 w-full rounded-md border border-amber-200 bg-amber-100 flex items-center space-x-2 p-4 transition-all duration-200 ease-in-out transform hover:-translate-y-0.5">
                    <i class="fa-solid fa-arrow-right-from-bracket text-amber-600"></i>
                    <span class="font-bold text-amber-600">
                        Logout
                    </span>

                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 sm:ml-64 p-6">
            <slot />
        </main>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-4px);
}
</style>
