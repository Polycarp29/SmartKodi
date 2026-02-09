<script setup>
import AuthLayout from '../Layouts/AuthLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';

const form = useForm({
    email: '',
});

const submitForgot = () => {
    form.post(route('auth.forgot-password.post'), {
        onSuccess: () => {
            toast.success('Reset link sent to your email.');
            form.reset();
        },
        onError: () => {
            toast.error('Failed to send reset link. Please check your email.');
        }
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Forgot Password" />

        <div class="w-full max-w-md">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Forgot Password?</h2>
                <p class="text-gray-500">
                    Enter your email address and we'll send you a link to reset your password.
                </p>
            </div>

            <form @submit.prevent="submitForgot" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input v-model="form.email" type="email"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="name@company.com" />
                    <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">{{ form.errors.email }}</div>
                </div>

                <button type="submit" :disabled="form.processing"
                    class="w-full bg-gradient-to-r from-amber-600 to-amber-500 text-white font-semibold py-3 rounded-lg shadow-lg shadow-amber-500/30 hover:shadow-amber-500/40 hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed">
                    <span v-if="form.processing">Sending Link...</span>
                    <span v-else>Send Reset Link</span>
                </button>
            </form>

            <div class="mt-8 text-center">
                <a :href="route('auth.login')"
                    class="text-amber-600 font-semibold hover:text-amber-700 transition-colors text-sm flex items-center justify-center gap-2">
                    <i class="fas fa-arrow-left"></i> Back to Login
                </a>
            </div>
        </div>
    </AuthLayout>
</template>
