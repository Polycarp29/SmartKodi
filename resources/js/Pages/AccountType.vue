<script setup>
import { ref } from 'vue';
import AuthLayout from '../Layouts/AuthLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';

const props = defineProps({
    roles: {
        type: Array,
        default: () => []
    }
});

const selectedType = ref('');

const form = useForm({
    id: '',
});

const submitSelection = () => {
    form.id = selectedType.value;
    form.post(route('account.select.post'));
};

</script>

<template>
    <AuthLayout>
        <Head title="Select Account Type" />
        <!--Left section  account type selection-->
        <div class="flex justify-center items-center min-h-screen bg-white">
            <div class="p-8 border border-gray-200 rounded-2xl shadow-sm w-full max-w-md">
                <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">
                    Select Account Type
                </h2>

                <div class="grid grid-cols-1 gap-4">
                    <label v-for="role in roles" :key="role.id"
                        class="flex items-start gap-3 p-4 border rounded-xl cursor-pointer transition-all" :class="selectedType === role.id
                            ? 'border-amber-500 bg-amber-50 shadow-inner'
                            : 'border-gray-200 hover:border-amber-400 hover:bg-amber-50/60'">
                        <input type="radio" name="account_type" :value="role.id" v-model="selectedType"
                            class="mt-1 accent-amber-600 cursor-pointer" />
                        <div>
                            <h3 class="text-gray-800 font-medium">{{ role.name }}</h3>
                            <p class="text-sm text-gray-500">{{ role.role_description }}</p>
                        </div>
                    </label>
                </div>

                <button type="button" @click="submitSelection"
                    class="w-full mt-6 bg-amber-600 hover:bg-amber-700 text-white font-semibold py-3 rounded-lg transition-colors disabled:opacity-50"
                    :disabled="!selectedType || form.processing">
                    <span v-if="form.processing">Saving...</span>
                    <span v-else>Continue</span>
                </button>
            </div>
        </div>
    </AuthLayout>
</template>