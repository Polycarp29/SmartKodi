<script setup>
import ElevatedButton from '../../Layouts/Widgets/ElevatedButton.vue';
import TransparentButton from '../../Layouts/Widgets/TransparentButton.vue';


</script>
<template>
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8 mt-8">
        <!-- Header -->
        <div class="text-center mb-10 ">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Create an account</h2>

            <p class="text-lg font-light text-gray-600 mb-2">Get started with your free
                account today</p>

        </div>
        <form id="loginForm">
            <!---Username-->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Username
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fa-regular fa-user text-gray-400"></i>
                    </div>
                    <input type="name" id="name" name="name" required
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300  rounded-lg focus:ring-2 focus:outline-none focus:ring-amber-500 focus:border-amber-500 transition-colors"
                        placeholder="John Doe">
                </div>
            </div>
            <!-- Email Field -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <input type="email" id="email" name="email" required
                        class="block w-full pl-10 pr-3 py-3 border border-gray-300  rounded-lg focus:ring-2 focus:outline-none focus:ring-amber-500 focus:border-amber-500 transition-colors"
                        placeholder="name@company.com">
                </div>
            </div>

            <!-- Password Field -->
            <div class="mb-2">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <input type="password" id="password" name="password" required
                        class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:outline-none focus:ring-amber-500 focus:border-amber-500 transition-colors"
                        placeholder="••••••••">
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!--Confirm Password-->
            <div class="mb-2">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Confirm Password
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                    </div>
                    <input type="password" id="password" name="password" required
                        class="block w-full pl-10 pr-10 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:outline-none focus:ring-amber-500 focus:border-amber-500 transition-colors"
                        placeholder="••••••••">
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                        class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                    <label for="remember" class="ml-2 text-sm text-gray-700">
                        Remember me
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <ElevatedButton class="w-full">Sign Up</ElevatedButton>

            <!-- Divider -->
            <div class="relative flex items-center my-8">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="flex-shrink mx-4 text-gray-500 text-sm">Or continue with</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- Social Login -->
            <div class="grid grid-cols-2 gap-4 mb-6">
                <TransparentButton></TransparentButton>
                <TransparentButton></TransparentButton>
            </div>
        </form>
    </div>
</template>