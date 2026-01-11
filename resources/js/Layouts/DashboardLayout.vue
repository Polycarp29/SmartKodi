<script setup>

import AsideNavigation from "../Components/Common/AsideNavigation.vue";


</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Sidebar -->
       <AsideNavigation></AsideNavigation>

        <!-- Main Content -->
        <main class="flex-1 sm:ml-64 p-6">
            <slot />
        </main>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(-4px);
}
</style>
