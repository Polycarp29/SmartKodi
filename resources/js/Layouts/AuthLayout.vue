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
                class="relative w-full max-w-xl p-10 bg-white/95 backdrop-blur-sm rounded-2xl shadow-2xl border border-gray-200/50">

                <!-- Brand -->
                <div class="mb-8">
                    <span class="text-sm font-semibold tracking-wider text-amber-600 uppercase">Property
                        Management</span>
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mt-2 tracking-tight">
                        SmartKoddi<span class="text-amber-600">.</span>
                    </h1>
                    <div class="h-1 w-16 bg-gradient-to-r from-amber-500 to-amber-300 mt-3 rounded-full"></div>
                </div>

                <!-- Value Prop -->
                <div class="mb-10">
                    <p class="text-2xl md:text-3xl font-semibold text-gray-800 mb-4">
                        Intelligent Property Platform
                    </p>
                    <p class="text-gray-600 text-lg">
                        Streamline operations and optimize portfolio performance with our comprehensive solution.
                    </p>
                </div>

                <!-- Features -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                    <div class="flex items-center gap-4 p-5 rounded-xl border border-gray-100 bg-white shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fas fa-chart-line text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Analytics</h3>
                            <p class="text-sm text-gray-500">Real-time insights</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-5 rounded-xl border border-gray-100 bg-white shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fas fa-cogs text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Automation</h3>
                            <p class="text-sm text-gray-500">Streamlined workflows</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-5 rounded-xl border border-gray-100 bg-white shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fas fa-shield-alt text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Compliance</h3>
                            <p class="text-sm text-gray-500">Risk management</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-5 rounded-xl border border-gray-100 bg-white shadow-sm">
                        <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fas fa-handshake text-amber-600"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800">Tenant Relations</h3>
                            <p class="text-sm text-gray-500">Enhanced communication</p>
                        </div>
                    </div>
                </div>

                <!-- Trust Badge -->
                <div class="mt-10 pt-6 border-t border-gray-100">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-check-circle text-green-500 mr-2"></i>
                        Trusted by 150+ property portfolios
                    </p>
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