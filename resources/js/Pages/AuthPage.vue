<script setup>
import AuthLayout from '../Layouts/AuthLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps({
    type: {
        type: String,
        default: 'login' // 'login' or 'register'
    }
});

const isLogin = ref(props.type === 'login');

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
                    <div v-if="loginForm.errors.email" class="text-red-500 text-xs mt-1">{{ loginForm.errors.email }}</div>
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <a :href="route('auth.forgot-password')" class="text-sm text-amber-600 hover:text-amber-700 font-medium">
                            Forgot password?
                        </a>
                    </div>
                    <input v-model="loginForm.password" type="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="••••••••" />
                    <div v-if="loginForm.errors.password" class="text-red-500 text-xs mt-1">{{ loginForm.errors.password }}</div>
                </div>

                <div class="flex items-center">
                    <input v-model="loginForm.remember" type="checkbox" id="remember"
                        class="h-4 w-4 text-amber-600 border-gray-300 rounded focus:ring-amber-500">
                    <label for="remember" class="ml-2 block text-sm text-gray-700">Remember me</label>
                </div>

                <button type="submit" :disabled="loginForm.processing"
                    class="w-full bg-gradient-to-r from-amber-600 to-amber-500 text-white font-semibold py-3 rounded-lg shadow-lg shadow-amber-500/30 hover:shadow-amber-500/40 hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed">
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
                    <div v-if="registerForm.errors.name" class="text-red-500 text-xs mt-1">{{ registerForm.errors.name }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input v-model="registerForm.email" type="email"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="name@company.com" />
                    <div v-if="registerForm.errors.email" class="text-red-500 text-xs mt-1">{{ registerForm.errors.email }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input v-model="registerForm.password" type="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="••••••••" />
                    <div v-if="registerForm.errors.password" class="text-red-500 text-xs mt-1">{{ registerForm.errors.password }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <input v-model="registerForm.password_confirmation" type="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="••••••••" />
                </div>

                <button type="submit" :disabled="registerForm.processing"
                    class="w-full bg-gradient-to-r from-amber-600 to-amber-500 text-white font-semibold py-3 rounded-lg shadow-lg shadow-amber-500/30 hover:shadow-amber-500/40 hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed">
                     <span v-if="registerForm.processing">Creating Account...</span>
                     <span v-else>Create Account</span>
                </button>
            </form>

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