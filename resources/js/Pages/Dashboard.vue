<script setup>
import DashboardLayout from '../Layouts/DashboardLayout.vue';

</script>

<template>
    <DashboardLayout>
        <div class="w-full h-screen">
            <!---Header-->
            <div class="p-6">
                <div class="flex justify-between space-y-2">
                    <div class="flex flex-col">
                        <h1 class="text-4xl font-bold text-gray-600">
                            Dashboard
                        </h1>
                        <p class="text-lg font-light text-gray-500">
                            Welcome to smartkoddi dashboard, we are excited to have you!
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>