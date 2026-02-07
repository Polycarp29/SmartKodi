<script setup>
import LargeCards from '../../Components/Cards/LargeCards.vue';
import DashboardLayout from '../../Layouts/DashboardLayout.vue';
import MediumCard from '../../Components/Cards/MediumCard.vue';
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
import { ref } from 'vue';

const roles = ref([
    { id: 1, name: 'Super Admin', users: 1, permissions: 'Full Access' },
    { id: 2, name: 'Property Manager', users: 3, permissions: 'Limited Financials' },
    { id: 3, name: 'Caretaker', users: 5, permissions: 'Maintenance Only' },
]);
</script>

<template>
    <DashboardLayout>
        <div class="space-y-6">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold text-gray-800">Roles & Permissions</h1>
                    <p class="text-sm font-semibold text-gray-500">
                        <a href="/settings" class="hover:text-amber-600 hover:underline">Settings</a> > 
                        <span class="text-amber-600">Roles & Permissions</span>
                    </p>
                </div>
                <ElevatedButton class="bg-purple-600">Add New Role</ElevatedButton>
            </div>

            <LargeCards>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-gray-100">
                                <th class="pb-4 pt-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Role Name</th>
                                <th class="pb-4 pt-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Active Users</th>
                                <th class="pb-4 pt-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Access Scope</th>
                                <th class="pb-4 pt-2 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr v-for="role in roles" :key="role.id" class="group hover:bg-purple-50/30 transition-colors">
                                <td class="py-4 font-bold text-gray-800">{{ role.name }}</td>
                                <td class="py-4 text-sm text-gray-500">{{ role.users }} Users</td>
                                <td class="py-4">
                                    <span class="px-3 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">{{ role.permissions }}</span>
                                </td>
                                <td class="py-4 text-right">
                                    <button class="text-purple-600 hover:text-purple-800 font-bold text-xs p-2">Edit</button>
                                    <button class="text-red-400 hover:text-red-600 font-bold text-xs p-2">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </LargeCards>

            <LargeCards>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h4 class="font-bold text-gray-800 mb-4">Quick Permission Matrix</h4>
                        <div class="space-y-3">
                            <div class="flex items-center justify-between p-3 border border-gray-100 rounded-xl">
                                <span class="text-sm text-gray-600">View Financial Reports</span>
                                <input type="checkbox" checked disabled class="rounded text-purple-600" />
                            </div>
                            <div class="flex items-center justify-between p-3 border border-gray-100 rounded-xl">
                                <span class="text-sm text-gray-600">Delete Property Records</span>
                                <input type="checkbox" disabled class="rounded text-purple-600" />
                            </div>
                        </div>
                    </div>
                </div>
            </LargeCards>
        </div>
    </DashboardLayout>
</template>
