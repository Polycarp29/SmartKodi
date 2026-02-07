<script setup>
import LargeCards from '../Components/Cards/LargeCards.vue';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import MediumCard from '../Components/Cards/MediumCard.vue';
</script>
<template>
    <DashboardLayout>
        <div class="space-y-4">
            <LargeCards>
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold py-2 text-gray-800">
                        Settings
                    </h1>
                    <p class="font-semibold text-gray-500 text-sm "><span class="hover:underline">Dashboard</span> >
                        <span class="text-amber-600 hover:underline">Settings</span>
                    </p>
                </div>
            </LargeCards>

            <!--Contect Card For settings-->

            <LargeCards>
               <div class="space-y-4 py-2 border-b border-gray-100 mb-4">
                    <p class="text-base font-light text-gray-500">
                        Update, access, create system based settings here for your account, incorporate AI based settings here.
                    </p>
               </div>
               
               <!--Grid based settings categories-->
               <div class="grid lg:grid-cols-2 xl:grid-cols-3 gap-6">
                    <!-- Subscriptions -->
                    <MediumCard class="hover:border-amber-400 transition-all cursor-pointer group">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-amber-100 rounded-lg text-amber-600 group-hover:bg-amber-600 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-sack-dollar text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-lg font-bold text-gray-800">Subscriptions</h3>
                                <p class="text-sm text-gray-500">Manage your plan, billing, and usage limits.</p>
                                <a href="/settings/subscriptions" class="inline-flex items-center text-amber-600 font-semibold text-sm hover:underline pt-2">
                                    Manage Plan <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </MediumCard>

                    <!-- AI Settings -->
                    <MediumCard class="hover:border-blue-400 transition-all cursor-pointer group">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-blue-100 rounded-lg text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-robot text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-lg font-bold text-gray-800">AI Recommendations</h3>
                                <p class="text-sm text-gray-500">Configure smart property suggestions and automated tasks.</p>
                                <a href="/settings/ai" class="inline-flex items-center text-blue-600 font-semibold text-sm hover:underline pt-2">
                                    Configure AI <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </MediumCard>

                    <!-- SMS & Outbound -->
                    <MediumCard class="hover:border-green-400 transition-all cursor-pointer group">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-green-100 rounded-lg text-green-600 group-hover:bg-green-600 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-comment-sms text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-lg font-bold text-gray-800">SMS & Messaging</h3>
                                <p class="text-sm text-gray-500">Manage outbound message templates and SMS gateway settings.</p>
                                <a href="/settings/sms" class="inline-flex items-center text-green-600 font-semibold text-sm hover:underline pt-2">
                                    Gateway Settings <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </MediumCard>

                    <!-- Roles & Permissions -->
                    <MediumCard class="hover:border-purple-400 transition-all cursor-pointer group">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-purple-100 rounded-lg text-purple-600 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-user-shield text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-lg font-bold text-gray-800">Roles & Permissions</h3>
                                <p class="text-sm text-gray-500">Define user roles and control access across the system.</p>
                                <a href="/settings/roles" class="inline-flex items-center text-purple-600 font-semibold text-sm hover:underline pt-2">
                                    Manage Access <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </MediumCard>

                    <!-- 2FA & Security -->
                    <MediumCard class="hover:border-red-400 transition-all cursor-pointer group">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-red-100 rounded-lg text-red-600 group-hover:bg-red-600 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-shield-halved text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-lg font-bold text-gray-800">Security & 2FA</h3>
                                <p class="text-sm text-gray-500">Enable Two-Factor Authentication and manage session security.</p>
                                <a href="/settings/security" class="inline-flex items-center text-red-600 font-semibold text-sm hover:underline pt-2">
                                    Setup Security <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </MediumCard>

                    <!-- Properties Settings -->
                    <MediumCard class="hover:border-orange-400 transition-all cursor-pointer group">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-orange-100 rounded-lg text-orange-600 group-hover:bg-orange-600 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-building-circle-check text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-lg font-bold text-gray-800">Properties Settings</h3>
                                <p class="text-sm text-gray-500">Configure property categories, amenities, and default unit types.</p>
                                <a href="/settings/properties" class="inline-flex items-center text-orange-600 font-semibold text-sm hover:underline pt-2">
                                    Configure Properties <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </MediumCard>

                    <!-- Profile Quick Link -->
                    <MediumCard class="hover:border-amber-400 transition-all cursor-pointer group">
                        <div class="flex items-start space-x-4">
                            <div class="p-3 bg-amber-50 rounded-lg text-amber-500 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-user-gear text-xl"></i>
                            </div>
                            <div class="space-y-1">
                                <h3 class="text-lg font-bold text-gray-800">Personal Profile</h3>
                                <p class="text-sm text-gray-500">Review your personal information and profile settings.</p>
                                <a href="/profile" class="inline-flex items-center text-amber-600 font-semibold text-sm hover:underline pt-2">
                                    View Profile <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </MediumCard>
               </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>