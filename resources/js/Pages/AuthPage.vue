<script setup>
import AuthLayout from '../Layouts/AuthLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { toast } from 'vue-sonner';
import SocialLogins from '../Layouts/Widgets/SocialLogins.vue';


const props = defineProps({
    type: {
        type: String,
        default: 'login' // 'login' or 'register'
    }
});

const isLogin = ref(props.type === 'login');
const showPassword = ref(false);

const toggleAuthMode = () => {
    isLogin.value = !isLogin.value;
};

const loginForm = useForm({
    email: '',
    password: '',
    remember: false,
});

const registerForm = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const showConfirmPassword = ref(false);

const submitLogin = () => {
    loginForm.post(route('auth.login.post'), {
        onSuccess: () => {
            // Toast handled by flash message in layout/controller usually, but we can double check
        },
        onError: (errors) => {
            toast.error('Login failed. Please check your credentials.');
        }
    });
};

const submitRegister = () => {
    registerForm.post(route('auth.register.post'), {
        onSuccess: () => {
            // Toast handled by controller redirect
        },
        onError: (errors) => {
            toast.error('Registration failed. Please check your input.');
        }
    });
};
</script>

<template>
    <AuthLayout>

        <Head :title="isLogin ? 'Login' : 'Register'" />

        <div class="w-full max-w-md">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">
                    {{ isLogin ? 'Welcome Back' : 'Create Account' }}
                </h2>
                <p class="text-gray-500">
                    {{ isLogin ? 'Enter your credentials to access your account' : 'Start your journey with us today' }}
                </p>
            </div>

            <!-- Login Form -->
            <form v-if="isLogin" @submit.prevent="submitLogin" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input v-model="loginForm.email" type="email"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="name@company.com" />
                    <div v-if="loginForm.errors.email" class="text-red-500 text-xs mt-1">{{ loginForm.errors.email }}
                    </div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <a :href="route('auth.forgot-password')"
                            class="text-sm text-amber-600 hover:text-amber-700 font-medium">
                            Forgot password?
                        </a>
                    </div>

                    <!-- Wrapper to position the toggle button correctly -->
                    <div class="relative">
                        <input v-model="loginForm.password" :type="showPassword ? 'text' : 'password'"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none pr-10"
                            placeholder="••••••••" />

                        <!-- Toggle visibility button -->
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>

                    <div v-if="loginForm.errors.password" class="text-red-500 text-xs mt-1">
                        {{ loginForm.errors.password }}
                    </div>
                </div>


                <div class="flex items-center">
                    <input v-model="loginForm.remember" type="checkbox" id="remember"
                        class="h-4 w-4 text-amber-600 border-gray-300 rounded focus:ring-amber-500">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>

                <button type="submit" :disabled="loginForm.processing"
                    class="w-full bg-amber-600 text-white font-semibold py-3 rounded-lg shadow-lg shadow-amber-500/30 hover:shadow-amber-500/40 hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed">
                    <span v-if="loginForm.processing">Signing in...</span>
                    <span v-else>Sign In</span>
                </button>
            </form>

            <!-- Register Form -->
            <form v-else @submit.prevent="submitRegister" class="space-y-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input v-model="registerForm.name" type="text"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="John Doe" />
                    <div v-if="registerForm.errors.name" class="text-red-500 text-xs mt-1">{{ registerForm.errors.name
                    }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input v-model="registerForm.email" type="email"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="name@company.com" />
                    <div v-if="registerForm.errors.email" class="text-red-500 text-xs mt-1">{{ registerForm.errors.email
                    }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>

                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" v-model="registerForm.password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none pr-10"
                            placeholder="••••••••" />
                        <!-- Eye Icon -->
                        <button type="button" @click="showPassword = !showPassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                            <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>

                    <div v-if="registerForm.errors.password" class="text-red-500 text-xs mt-1">{{
                        registerForm.errors.password }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>

                    <div class="relative">
                        <input :type="showConfirmPassword ? 'text' : 'password'"
                            v-model="registerForm.password_confirmation"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none pr-10"
                            placeholder="••••••••" />
                        <!-- Eye Icon -->
                        <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700">
                            <svg v-if="!showConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>

                        </button>
                    </div>
                </div>


                <button type="submit" :disabled="registerForm.processing"
                    class="w-full bg-amber-600 text-white font-semibold py-3 rounded-lg shadow-lg shadow-amber-500/30 hover:shadow-amber-500/40 hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed">
                    <span v-if="registerForm.processing">Creating Account...</span>
                    <span v-else>Create Account</span>
                </button>
            </form>

            <div class="relative flex items-center my-8">
                <div class="flex-grow border-t border-gray-300"></div>
                <span class="flex-shrink mx-4 text-gray-500 text-sm">Or continue with</span>
                <div class="flex-grow border-t border-gray-300"></div>
            </div>

            <!-- Social Login -->
            <SocialLogins></SocialLogins>

            <!-- Toggle -->
            <div class="mt-8 text-center">
                <p class="text-gray-600">
                    {{ isLogin ? "Don't have an account?" : "Already have an account?" }}
                    <button @click="toggleAuthMode"
                        class="text-amber-600 font-semibold hover:text-amber-700 ml-1 transition-colors">
                        {{ isLogin ? 'Sign up' : 'Sign in' }}
                    </button>
                </p>
            </div>
        </div>
    </AuthLayout>
</template>