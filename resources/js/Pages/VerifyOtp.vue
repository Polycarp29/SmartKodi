<script setup>
import AuthLayout from '../Layouts/AuthLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import { toast } from 'vue-sonner';

const props = defineProps({
    email: {
        type: String,
        required: true,
    }
});

const form = useForm({
    email: props.email,
    otp: '',
});

const resendForm = useForm({
    email: props.email,
});

const submitVerify = () => {
    form.post(route('auth.verify-otp.post'), {
        onSuccess: () => {
            // Success handled by controller redirect with flash
        },
        onError: () => {
             toast.error('Verification failed. Invalid or expired code.');
        }
    });
};

const resendOtp = () => {
    resendForm.post(route('auth.resend-otp'), {
        onSuccess: () => {
             toast.success('New code sent!');
        },
        onError: () => {
             toast.error('Failed to resend code. Please try later.');
        }
    });
};
</script>

<template>
    <AuthLayout>
        <Head title="Verify OTP" />

        <div class="w-full max-w-md">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Verify Your Email</h2>
                <p class="text-gray-500">
                    We've sent a 6-digit verification code to <span class="font-medium text-gray-900">{{ email }}</span>.
                </p>
            </div>

            <form @submit.prevent="submitVerify" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Enter OTP Code</label>
                    <input v-model="form.otp" type="text" maxlength="6"
                        class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all outline-none text-center text-2xl tracking-widest font-mono"
                        placeholder="123456" />
                    <div v-if="form.errors.otp" class="text-red-500 text-xs mt-1">{{ form.errors.otp }}</div>
                </div>

                <button type="submit" :disabled="form.processing"
                    class="w-full bg-gradient-to-r from-amber-600 to-amber-500 text-white font-semibold py-3 rounded-lg shadow-lg shadow-amber-500/30 hover:shadow-amber-500/40 hover:-translate-y-0.5 transition-all duration-200 disabled:opacity-70 disabled:cursor-not-allowed">
                    <span v-if="form.processing">Verifying...</span>
                    <span v-else>Verify Account</span>
                </button>
            </form>

            <div class="mt-8 text-center text-sm">
                <p class="text-gray-600">
                    Didn't receive the code?
                    <button @click="resendOtp" :disabled="resendForm.processing"
                        class="text-amber-600 font-semibold hover:text-amber-700 ml-1 transition-colors disabled:opacity-50">
                        {{ resendForm.processing ? 'Resending...' : 'Resend Code' }}
                    </button>
                </p>
            </div>
        </div>
    </AuthLayout>
</template>
