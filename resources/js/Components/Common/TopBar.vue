<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <header class="bg-white border-b border-gray-200 h-16 flex items-center justify-between px-6 sticky top-0 z-30">
        <!-- Left: Page Title (Optional or Breadcrumbs) -->
        <div class="flex items-center">
            <h2 class="text-lg font-bold text-gray-800 tracking-tight">
               <slot name="title"></slot>
            </h2>
        </div>

        <!-- Right: Actions -->
        <div class="flex items-center gap-4">
            <!-- Notifications -->
            <Link href="/notifications" class="relative p-2 text-gray-400 hover:text-amber-600 transition-colors rounded-full hover:bg-amber-50">
                <i class="fa-regular fa-bell text-xl"></i>
                <span class="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
            </Link>

            <div class="h-8 w-px bg-gray-200 mx-2"></div>

            <!-- Profile Dropdown (Simplified for now) -->
            <div class="flex items-center gap-3">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-gray-700">John Doe</p>
                    <p class="text-xs text-gray-400 font-medium">Administrator</p>
                </div>
                <img src="https://i.pravatar.cc/150?u=a042581f4e29026704d" alt="User" class="w-10 h-10 rounded-full border-2 border-amber-100 p-0.5 object-cover" />
            </div>
        </div>
    </header>
</template>
