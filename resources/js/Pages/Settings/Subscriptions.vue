<script setup>
import LargeCards from '../../Components/Cards/LargeCards.vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
</script>

<template>
    <DashboardLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold text-gray-800">Subscriptions</h1>
                    <p class="text-sm font-semibold text-gray-500">
                        <a href="/settings" class="hover:text-amber-600 hover:underline">Settings</a> > 
                        <span class="text-amber-600">Subscriptions</span>
                    </p>
                </div>
                <ElevatedButton class="bg-amber-600">Upgrade Plan</ElevatedButton>
            </div>

            <LargeCards>
                <div class="grid lg:grid-cols-3 gap-6">
                    <!-- Current Plan Card -->
                    <MediumCard class="col-span-1 border-amber-200 bg-amber-50/50">
                        <div class="space-y-4">
                            <h3 class="text-lg font-bold text-gray-800">Current Plan</h3>
                            <div class="py-2">
                                <span class="text-4xl font-extrabold text-amber-600">Free</span>
                                <p class="text-sm text-gray-500 mt-1">Perfect for getting started</p>
                            </div>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-amber-600"></i> Up to 5 Properties
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="fa-solid fa-check text-amber-600"></i> 10 Units
                                </li>
                                <li class="flex items-center gap-2 text-gray-400 line-through">
                                    <i class="fa-solid fa-xmark"></i> AI Recommendations
                                </li>
                            </ul>
                        </div>
                    </MediumCard>

                    <!-- Usage Stats -->
                    <div class="lg:col-span-2 grid md:grid-cols-2 gap-4">
                        <MediumCard>
                            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Properties Used</h4>
                            <div class="mt-2 flex items-end justify-between">
                                <span class="text-3xl font-bold text-gray-800">3 / 5</span>
                                <div class="w-full max-w-[120px] bg-gray-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-amber-600 h-full w-[60%]"></div>
                                </div>
                            </div>
                        </MediumCard>
                        <MediumCard>
                            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wider">Units Used</h4>
                            <div class="mt-2 flex items-end justify-between">
                                <span class="text-3xl font-bold text-gray-800">8 / 10</span>
                                <div class="w-full max-w-[120px] bg-gray-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-amber-600 h-full w-[80%]"></div>
                                </div>
                            </div>
                        </MediumCard>
                    </div>
                </div>
            </LargeCards>

            <!-- Available Plans -->
            <LargeCards>
                <h2 class="text-xl font-bold text-gray-800 mb-6">Available Plans</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="border border-gray-100 rounded-2xl p-6 hover:border-amber-400 transition-all cursor-pointer">
                        <h4 class="font-bold text-gray-800">Pro Plan</h4>
                        <div class="mt-4 flex items-baseline gap-1">
                            <span class="text-3xl font-bold">$29</span>
                            <span class="text-sm text-gray-500">/mo</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-2">Scale your property portfolio seamlessly.</p>
                        <ul class="mt-6 space-y-3 text-sm">
                            <li class="flex items-center gap-2 text-gray-600">
                                <i class="fa-solid fa-check text-green-500"></i> Unlimited Properties
                            </li>
                            <li class="flex items-center gap-2 text-gray-600">
                                <i class="fa-solid fa-check text-green-500"></i> AI Smart Insights
                            </li>
                        </ul>
                    </div>
                    <!-- Extra plan cards can be added here -->
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
