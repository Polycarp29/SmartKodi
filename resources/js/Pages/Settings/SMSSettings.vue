<script setup>
import LargeCards from '../../Components/Cards/LargeCards.vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
import { ref } from 'vue';

const gateway = ref('twillio');
const apiKey = ref('**************************');
</script>

<template>
    <DashboardLayout>
        <div class="space-y-6">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold text-gray-800">SMS & Messaging</h1>
                <p class="text-sm font-semibold text-gray-500">
                    <a href="/settings" class="hover:text-amber-600 hover:underline">Settings</a> > 
                    <span class="text-amber-600">SMS & Messaging</span>
                </p>
            </div>

            <LargeCards>
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-tower-broadcast text-green-600"></i>
                        Gateway Configuration
                    </h3>
                    
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">SMS Provider</label>
                            <select v-model="gateway" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-green-500 focus:border-green-500 p-3">
                                <option value="twillio">Twilio</option>
                                <option value="africastalking">Africas Talking</option>
                                <option value="nexmo">Nexmo (Vonage)</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">API Key / Auth Token</label>
                            <input v-model="apiKey" type="password" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-green-500 focus:border-green-500 p-3" />
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h4 class="font-bold text-gray-800 mb-4 text-sm">Outbound Message Templates</h4>
                        <div class="space-y-3">
                            <MediumCard class="flex items-center justify-between py-3 px-4">
                                <span class="text-sm font-medium text-gray-700">Rent Payment Reminder</span>
                                <button class="text-xs font-bold text-green-600 hover:underline">Edit Template</button>
                            </MediumCard>
                            <MediumCard class="flex items-center justify-between py-3 px-4">
                                <span class="text-sm font-medium text-gray-700">Maintenance Update</span>
                                <button class="text-xs font-bold text-green-600 hover:underline">Edit Template</button>
                            </MediumCard>
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <ElevatedButton class="bg-green-600 shadow-green-100">Update Messaging Settings</ElevatedButton>
                    </div>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
