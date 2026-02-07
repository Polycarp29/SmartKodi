<script setup>
import LargeCards from '../../Components/Cards/LargeCards.vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
import { ref } from 'vue';

const propertyCategories = ref(['Residential', 'Commercial', 'Mixed Use', 'Industrial']);
const amenities = ref(['Swimming Pool', 'Gym', 'Parking', 'Security', 'Wifi']);
</script>

<template>
    <DashboardLayout>
        <div class="space-y-6">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold text-gray-800">Properties Settings</h1>
                <p class="text-sm font-semibold text-gray-500">
                    <a href="/settings" class="hover:text-amber-600 hover:underline">Settings</a> > 
                    <span class="text-amber-600">Properties Settings</span>
                </p>
            </div>

            <LargeCards>
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Property Categories -->
                    <div class="space-y-6">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-tags text-orange-600"></i>
                            Property Categories
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="cat in propertyCategories" :key="cat" class="px-4 py-2 bg-orange-50 text-orange-700 rounded-xl text-sm font-bold border border-orange-100 flex items-center gap-2">
                                {{ cat }}
                                <button class="text-xs text-orange-400 hover:text-orange-600">&times;</button>
                            </span>
                            <button class="px-4 py-2 border-2 border-dashed border-gray-200 text-gray-400 rounded-xl text-sm font-bold hover:border-orange-400 hover:text-orange-600 transition-all">+ Add</button>
                        </div>
                    </div>

                    <!-- Amenities -->
                    <div class="space-y-6">
                        <h3 class="font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-sparkles text-orange-600"></i>
                            Global Amenities
                        </h3>
                        <div class="flex flex-wrap gap-2">
                            <span v-for="amenity in amenities" :key="amenity" class="px-4 py-2 bg-gray-50 text-gray-700 rounded-xl text-sm font-bold border border-gray-100 flex items-center gap-2">
                                {{ amenity }}
                                <button class="text-xs text-gray-400 hover:text-gray-600">&times;</button>
                            </span>
                            <button class="px-4 py-2 border-2 border-dashed border-gray-200 text-gray-400 rounded-xl text-sm font-bold hover:border-orange-400 hover:text-orange-600 transition-all">+ Add</button>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-50">
                    <h3 class="font-bold text-gray-800 mb-6">Unit Configuration</h3>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Default Lease Period</label>
                            <select class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm p-3 focus:ring-orange-500">
                                <option>12 Months</option>
                                <option>6 Months</option>
                                <option>Month-to-Month</option>
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Currency Symbol</label>
                            <input type="text" value="Ksh" class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm p-3 focus:ring-orange-500" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-end pt-8">
                    <ElevatedButton class="bg-orange-600">Save Configuration</ElevatedButton>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
