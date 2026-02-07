<script setup>
import LargeCards from '../../Components/Cards/LargeCards.vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
import { ref } from 'vue';

const aiEnabled = ref(true);
const recommendations = ref(true);
const automatedFollowUps = ref(false);
</script>

<template>
    <DashboardLayout>
        <div class="space-y-6">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold text-gray-800">AI Recommendations</h1>
                <p class="text-sm font-semibold text-gray-500">
                    <a href="/settings" class="hover:text-amber-600 hover:underline">Settings</a> > 
                    <span class="text-amber-600">AI Recommendations</span>
                </p>
            </div>

            <LargeCards>
                <div class="space-y-6">
                    <div class="flex items-center justify-between p-4 bg-blue-50 rounded-2xl border border-blue-100">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-blue-600 text-white rounded-xl shadow-lg">
                                <i class="fa-solid fa-robot text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">AI Engine Status</h3>
                                <p class="text-sm text-gray-500">Enable or disable AI-powered features across the system.</p>
                            </div>
                        </div>
                        <button @click="aiEnabled = !aiEnabled" 
                            :class="aiEnabled ? 'bg-blue-600' : 'bg-gray-300'"
                            class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out">
                            <span :class="aiEnabled ? 'translate-x-5' : 'translate-x-0'"
                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                        </button>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6" v-if="aiEnabled">
                        <MediumCard class="hover:border-blue-300 transition-all">
                            <div class="space-y-4">
                                <div class="flex items-start justify-between">
                                    <h4 class="font-bold text-gray-800">Smart Pricing</h4>
                                    <input type="checkbox" v-model="recommendations" class="rounded text-blue-600 focus:ring-blue-500 w-5 h-5" />
                                </div>
                                <p class="text-sm text-gray-500">Automatically suggest optimal rent prices based on market trends and demand.</p>
                            </div>
                        </MediumCard>

                        <MediumCard class="hover:border-blue-300 transition-all">
                            <div class="space-y-4">
                                <div class="flex items-start justify-between">
                                    <h4 class="font-bold text-gray-800">Automated Follow-ups</h4>
                                    <input type="checkbox" v-model="automatedFollowUps" class="rounded text-blue-600 focus:ring-blue-500 w-5 h-5" />
                                </div>
                                <p class="text-sm text-gray-500">AI-driven messaging for maintenance requests and tenant inquiries.</p>
                            </div>
                        </MediumCard>
                    </div>

                    <div class="flex justify-end pt-4">
                        <ElevatedButton class="bg-blue-600">Save AI Preferences</ElevatedButton>
                    </div>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
