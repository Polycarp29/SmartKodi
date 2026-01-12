<script setup>
import DashboardLayout from '../Layouts/DashboardLayout.vue'
import MediumCard from '../Components/Cards/MediumCard.vue';
import Navigation from '../Components/Common/Navigations.vue'
import { ref } from 'vue'

const activeTab = ref('insights')

const insights = [
    {
        title: 'Occupancy Rate',
        detail: 'Current occupancy is 92%, up 5% from last month.',
    },
    {
        title: 'Late Payments',
        detail: '3 tenants have overdue rent payments totaling $2,400.',
    },
    {
        title: 'Top Performing Unit',
        detail: 'Unit A3 has maintained 100% occupancy for 8 months.',
    },
]

const recommendations = [
    {
        title: 'Review Rent Prices',
        detail:
            'Market data suggests you could increase rent by 3–5% for downtown units.',
    },
    {
        title: 'Send Payment Reminders',
        detail: 'Automate reminders for overdue tenants to reduce delays.',
    },
    {
        title: 'Energy Efficiency Audit',
        detail: 'AI suggests scheduling an audit to reduce common area utility costs.',
    },
]

</script>

<template>
    <DashboardLayout>
        <!--Navigation-->
        <Navigation></Navigation>
        <MediumCard>
            <div class="border-b border-gray-200 flex flex-row">
                <button class="px-4 py-2 font-semibold transition"
                    :class="activeTab === 'insights' ? 'text-amber-600 border-b-2 border-amber-600 font-bold' : 'text-gray-600'"
                    @click="activeTab = 'insights'">
                    Insights
                </button>

                <button class="px-4 py-2 font-semibold transition"
                    :class="activeTab === 'recommendations' ? 'text-amber-600 border-b-2 border-amber-600 font-bold' : 'text-gray-600'"
                    @click="activeTab = 'recommendations'">
                    Recommendations
                </button>
            </div>

            <div class="p-4">
                <div v-if="activeTab === 'insights'" class="space-y-3">
                    <h3 class="text-lg font-semibold text-gray-800">AI Insights</h3>
                    <ul class="space-y-2">
                        <li v-for="(item, index) in insights" :key="index"
                            class="p-3 bg-amber-50 rounded-md border border-amber-100">
                            <p class="font-semibold text-amber-700">{{ item.title }}</p>
                            <p class="text-gray-700 text-sm">{{ item.detail }}</p>
                        </li>
                    </ul>
                </div>

                <div v-else class="space-y-3">
                    <h3 class="text-lg font-semibold text-gray-800">AI Recommendations</h3>
                    <ul class="space-y-2">
                        <li v-for="(item, index) in recommendations" :key="index"
                            class="p-3 bg-gray-50 rounded-md border border-gray-100">
                            <p class="font-semibold text-amber-700">{{ item.title }}</p>
                            <p class="text-gray-700 text-sm">{{ item.detail }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </MediumCard>
    </DashboardLayout>
</template>