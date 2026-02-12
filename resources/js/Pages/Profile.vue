<script setup>
import { ref } from 'vue';
import LargeCards from '../Components/Cards/LargeCards.vue';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import ElevatedButton from '../Layouts/Widgets/ElevatedButton.vue';


// define props


const props = defineProps({
    data: {
        type: Object,
        default: () => ({}),
    }
})

const profile = ref({
    ...props.data,
    email: props.data?.user?.email ?? '',
});

const avatarPreview = ref(null);

const handleAvatarChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        avatarPreview.value = URL.createObjectURL(file);
    }
};
</script>

<template>
    <DashboardLayout>
        <div class="py-6 mt-4">
            <ul class="flex flex-row space-x-2 text-sm font-semibold">
                <li>
                    <a href="/dashboard" class="text-gray-500 hover:text-amber-600 hover:underline">Dashboard</a>
                </li>
                <li class="text-gray-400">/</li>
                <li>
                    <span class="text-amber-600">Profile</span>
                </li>
            </ul>
            <h1 class="text-3xl font-bold text-gray-800 py-4">User Profile</h1>
        </div>

        <div class="flex flex-col lg:flex-row gap-8 pb-12">
            <!-- Sidebar Navigation -->
            <aside class="w-full lg:w-72 shrink-0">
                <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-sm sticky top-6">
                    <nav class="space-y-2">
                        <a href="/profile"
                            class="flex items-center space-x-3 px-4 py-3 text-sm font-bold bg-amber-600 text-white rounded-xl shadow-md shadow-amber-200 transition-all">
                            <i class="fa-solid fa-user w-5"></i>
                            <span>Personal Profile</span>
                        </a>
                        <a href="/settings"
                            class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-amber-50 hover:text-amber-600 rounded-xl transition-all">
                            <i class="fa-solid fa-sack-dollar w-5"></i>
                            <span>Subscriptions</span>
                        </a>
                        <a href="/settings"
                            class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-amber-50 hover:text-amber-600 rounded-xl transition-all">
                            <i class="fa-solid fa-shield-halved w-5"></i>
                            <span>Security & 2FA</span>
                        </a>
                        <a href="/settings"
                            class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-amber-50 hover:text-amber-600 rounded-xl transition-all">
                            <i class="fa-solid fa-user-shield w-5"></i>
                            <span>Roles & Permissions</span>
                        </a>
                        <a href="/settings"
                            class="flex items-center space-x-3 px-4 py-3 text-sm font-semibold text-gray-600 hover:bg-amber-50 hover:text-amber-600 rounded-xl transition-all">
                            <i class="fa-solid fa-users w-5"></i>
                            <span>Team Management</span>
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Main Content Form -->
            <main class="flex-1 space-y-8">
                <!-- Avatar Section -->
                <section class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm">
                    <div class="flex flex-col md:flex-row items-center gap-8">
                        <div class="relative group">
                            <div
                                class="w-32 h-32 rounded-3xl bg-amber-100 border-4 border-white shadow-xl overflow-hidden overflow-hidden">
                                <img v-if="avatarPreview" :src="avatarPreview" class="w-full h-full object-cover" />
                                <div v-else class="w-full h-full flex items-center justify-center text-amber-600">
                                    <i class="fa-solid fa-user text-5xl"></i>
                                </div>
                            </div>
                            <label
                                class="absolute -bottom-2 -right-2 bg-white border border-gray-200 p-2 rounded-xl shadow-lg cursor-pointer hover:bg-amber-50 hover:text-amber-600 transition-all transition-all transition-all">
                                <i class="fa-solid fa-camera text-sm"></i>
                                <input type="file" class="hidden" @change="handleAvatarChange" accept="image/*">
                            </label>
                        </div>
                        <div class="text-center md:text-left space-y-1">
                            <h2 class="text-xl font-bold text-gray-800">Profile Picture</h2>
                            <p class="text-sm text-gray-500">JPG, GIF or PNG. Max size of 2MB</p>
                            <div class="flex gap-2 pt-2">
                                <button
                                    class="text-xs font-bold text-amber-600 border border-amber-200 px-3 py-1.5 rounded-lg hover:bg-amber-50">Upload
                                    New</button>
                                <button
                                    class="text-xs font-bold text-gray-400 hover:text-red-500 transition-colors">Remove</button>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Information Grid -->
                <section class="bg-white border border-gray-200 rounded-2xl p-8 shadow-sm space-y-8">
                    <!-- Personal Information -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-id-card text-amber-600"></i>
                            Personal Information
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">First
                                    Name</label>
                                <input v-model="profile.first_name" type="text"
                                    class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500 p-3" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Middle
                                    Name</label>
                                <input v-model="profile.middle_name" type="text"
                                    class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500 p-3" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Last
                                    Name</label>
                                <input v-model="profile.last_name" type="text"
                                    class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500 p-3" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Email
                                    Address</label>
                                <input v-model="profile.email" type="email" disabled
                                    class="w-full bg-gray-100 border-gray-200 rounded-xl text-sm text-gray-500 p-3 cursor-not-allowed" />
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Phone
                                    Number</label>
                                <input v-model="profile.phone" type="text"
                                    class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500 p-3" />
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-100" />

                    <!-- Address Details -->
                    <div class="space-y-6">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <i class="fa-solid fa-location-dot text-amber-600"></i>
                            Address Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Country</label>
                                <select v-model="profile.country"
                                    class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500 p-3">
                                    <option>Kenya</option>
                                    <option>Uganda</option>
                                    <option>Tanzania</option>
                                </select>
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">City</label>
                                <input v-model="profile.city" type="text"
                                    class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500 p-3" />
                            </div>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Address Line
                                1</label>
                            <input v-model="profile.address_line_1" type="text"
                                class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500 p-3" />
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Address Line 2
                                (Optional)</label>
                            <input v-model="profile.address_line_2" type="text"
                                class="w-full bg-gray-50 border-gray-200 rounded-xl text-sm focus:ring-amber-500 focus:border-amber-500 p-3" />
                        </div>
                    </div>

                    <!-- Footer Actions -->
                    <div class="flex justify-end items-center gap-4 pt-4">
                        <button
                            class="px-6 py-2.5 text-sm font-bold text-gray-400 hover:text-red-500 transition-colors">
                            Discard
                        </button>
                        <ElevatedButton>
                            Update Profile
                        </ElevatedButton>
                    </div>
                </section>
            </main>
        </div>
    </DashboardLayout>
</template>