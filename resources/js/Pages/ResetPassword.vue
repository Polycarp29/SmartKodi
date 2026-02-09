<script setup>
import AuthLayout from '../Layouts/AuthLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';

const props = defineProps({
    token: String,
    email: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submitReset = () => {
    form.post(route('auth.reset-password.post'), {
        onSuccess: () => {
             // Handled by redirect
        },
        onError: () => {
            toast.error('Password reset failed.');
        }
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Reset Password" />

        <div class="w-full max-w-md">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Set New Password</h2>
                <p class="text-gray-500">
                    Your new password must be different from your previously used passwords.
                </p>
            </div>

            <form @submit.prevent="submitReset" class="space-y-5">
                <input type="hidden" v-model="form.token">
                <input type="hidden" v-model="form.email">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input v-model="form.password" type="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="••••••••" />
                    <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">{{ form.errors.password }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                    <input v-model="form.password_confirmation" type="password"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none"
                        placeholder="••••••••" />
                </div>

                <button type="submit" :disabled="form.processing"
                    class="w-full bg-gradient-to-r from-amber-600 to-amber-500 text-white font-semibold py-3 rounded-lg shadow-lg shadow-amber-500/30 hover:shadow-amber-500/40 hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed">
                     <span v-if="form.processing">Resetting...</span>
                     <span v-else>Reset Password</span>
                </button>
            </form>
        </div>
    </AuthLayout>
</template>
