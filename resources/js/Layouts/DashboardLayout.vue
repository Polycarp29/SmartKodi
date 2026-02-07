<script setup>
import AsideNavigation from "../Components/Common/AsideNavigation.vue";
import TopBar from "../Components/Common/TopBar.vue";

</script>

<template>
    <div class="min-h-screen bg-gray-50 flex">
        <!-- Sidebar -->
        <AsideNavigation />

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col sm:ml-64 transition-all duration-300">
             <!-- Top Bar -->
            <TopBar />

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                <slot />
            </main>
        </div>
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
