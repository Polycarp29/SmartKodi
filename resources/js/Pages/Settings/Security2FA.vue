<script setup>
import LargeCards from '../../Components/Cards/LargeCards.vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
import { ref } from 'vue';

const mfaEnabled = ref(false);
</script>

<template>
    <DashboardLayout>
        <div class="space-y-6">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold text-gray-800">Security & 2FA</h1>
                <p class="text-sm font-semibold text-gray-500">
                    <a href="/settings" class="hover:text-amber-600 hover:underline">Settings</a> > 
                    <span class="text-amber-600">Security & 2FA</span>
                </p>
            </div>

            <LargeCards>
                <div class="space-y-8">
                    <!-- MFA Section -->
                    <div class="flex items-center justify-between p-6 bg-red-50 rounded-2xl border border-red-100">
                        <div class="flex items-center gap-4">
                            <div class="p-3 bg-red-600 text-white rounded-xl shadow-lg">
                                <i class="fa-solid fa-shield-halved text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">Two-Factor Authentication (2FA)</h3>
                                <p class="text-sm text-gray-500">Add an extra layer of security to your account.</p>
                            </div>
                        </div>
                        <ElevatedButton @click="mfaEnabled = !mfaEnabled" :class="mfaEnabled ? 'bg-red-700' : 'bg-red-600'">
                            {{ mfaEnabled ? 'Disable 2FA' : 'Enable 2FA' }}
                        </ElevatedButton>
                    </div>

                    <!-- Password Section -->
                    <div class="space-y-6 pt-4">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-key text-red-600"></i>
                            Change Password
                        </h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Current Password</label>
                                <input type="password" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm p-3 focus:ring-red-500 focus:border-red-500" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">New Password</label>
                                <input type="password" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm p-3 focus:ring-red-500 focus:border-red-500" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Confirm New Password</label>
                                <input type="password" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm p-3 focus:ring-red-500 focus:border-red-500" />
                            </div>
                        </div>
                        <div class="flex justify-end">
                            <ElevatedButton class="bg-gray-800">Update Password</ElevatedButton>
                        </div>
                    </div>

                    <hr class="border-gray-50" />

                    <!-- Active Sessions -->
                    <div class="space-y-4">
                        <h3 class="font-bold text-gray-800">Active Sessions</h3>
                        <MediumCard class="flex items-center justify-between p-4 bg-gray-50/50">
                            <div class="flex items-center gap-4">
                                <i class="fa-solid fa-desktop text-gray-400 text-xl"></i>
                                <div>
                                    <p class="text-sm font-bold text-gray-800">Chrome on MacOS</p>
                                    <p class="text-xs text-gray-500">Nairobi, Kenya • IP: 192.168.1.1</p>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-[10px] font-bold uppercase tracking-wider">Current Session</span>
                        </MediumCard>
                    </div>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
