<script setup>
import DashboardLayout from '../Layouts/DashboardLayout.vue';

</script>

<template>
    <DashboardLayout>
        <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Welcome to Dashboard</h1>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Example Dashboard Card -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Total Users</h3>
                    <p class="text-3xl font-bold text-blue-600">0</p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Active Sessions</h3>
                    <p class="text-3xl font-bold text-green-600">0</p>
                </div>
                
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Reports</h3>
                    <p class="text-3xl font-bold text-purple-600">0</p>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>