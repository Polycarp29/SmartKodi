<script setup>
import AuthLayout from '../Layouts/AuthLayout.vue';
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import LoginForm from './Components/LoginForm.vue';
import RegistrationForm from './Components/RegistrationForm.vue';

const view = ref('login');

const toggleAuth = () => {
    view.value = view.value === 'login' ? 'register' : 'login';
}





</script>

<template>

    <Head title="Login" />

    <AuthLayout>
        <div class=" min-h-screen">
            <!-- Create Account Link -->
            <div class="absolute top-8 right-8">
                <button @click="toggleAuth()"
                    class="inline-flex items-center gap-2 text-amber-600 hover:text-amber-700 font-semibold transition-colors group">
                    <span>{{ view == 'login' ? 'Create an account ?' : 'Already have an account ?' }}</span>
                </button>
            </div>

            <!-- Main Content -->
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="w-full max-w-md">

                    <!-- Auth Forms -->
                    <transition name="fade" mode="out-in">
                        <LoginForm v-if="view === 'login'"></LoginForm>
                        <RegistrationForm v-else-if="view === 'register'"></RegistrationForm>
                    </transition>



                    <!-- Footer Note -->
                    <p class="text-center text-gray-500 text-xs mt-8">
                        By continuing, you agree to our
                        <a href="/terms" class="text-amber-600 hover:text-amber-700">Terms</a>
                        and
                        <a href="/privacy" class="text-amber-600 hover:text-amber-700">Privacy Policy</a>
                    </p>
                </div>
            </div>
        </div>

    </AuthLayout>
</template>

<!--Style-->
<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>