<script setup>
// No imports needed yet
</script>

<template>

    <div class="min-h-screen flex flex-col lg:flex-row bg-cover bg-center">
        <!-- Left Section -->
        <div class="hidden lg:w-1/2 relative p-8 lg:flex justify-center items-center lg:min-h-[500px]">
            <!-- Background Image -->
            <div class="absolute inset-0 bg-cover bg-center"
                style="background-image: url('/defaults/property.jpeg'); background-position: center 30%;">
            </div>

            <!-- Subtle gradient overlay for better readability -->
            <div class="absolute inset-0 bg-gradient-to-r from-yellow-900/70 to-amber-900/40"></div>

            <!-- Content Container -->
            <div
                class="relative w-full max-w-2xl p-10 md:p-12 bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20">
                <!-- Logo/Brand Mark -->
                <div class="flex items-center gap-4 mb-6">
                    <div>
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 tracking-tight">
                            SmartKoddi
                        </h1>
                        <div class="h-1 w-20 bg-amber-600 mt-2 rounded-full"></div>
                    </div>
                </div>

                <!-- Tagline -->
                <p class="text-2xl md:text-3xl  font-semibold text-gray-600 leading-tight mb-6">
                    Advanced Property Management Solutions
                </p>

                <!-- Description -->
                <p class="text-gray-600 text-lg leading-relaxed mb-8 max-w-lg">
                    Streamline operations, optimize performance, and elevate your property portfolio with our
                    comprehensive management platform.
                </p>

                <!-- Feature Highlights -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                    <div class="flex items-center gap-3 bg-amber-100/80 p-6 rounded-xl border border-amber-300">
                        <i class="fa-regular fa-star text-amber-600"></i>
                        <span class="text-gray-700 font-medium">Portfolio Analytics</span>
                    </div>
                    <div class="flex items-center gap-3 bg-amber-100/80 p-6 rounded-xl border border-amber-300">
                        <i class="fa-regular fa-star text-amber-600"></i>
                        <span class="text-gray-700 font-medium">Portfolio Analytics</span>
                    </div>
                    <div class="flex items-center gap-3 bg-amber-100/80 p-6 rounded-xl border border-amber-300">
                       <i class="fa-regular fa-star text-amber-600"></i>
                        <span class="text-gray-700 font-medium">Portfolio Analytics</span>
                    </div>
                    <div class="flex items-center gap-3 bg-amber-100/80 p-6 rounded-xl border border-amber-300">
                       <i class="fa-regular fa-star text-amber-600"></i>
                        <span class="text-gray-700 font-medium">Portfolio Analytics</span>
                    </div>
                </div>
            </div>

            <!-- Decorative element -->
            <div class="absolute bottom-8 right-8 w-24 h-24 border-2 border-amber-500/20 rounded-full"></div>
        </div>


        <!-- Right Section Slot -->
        <div class="lg:w-1/2 p-8 flex justify-center items-center">
            <slot />
        </div>
    </div>


</template>