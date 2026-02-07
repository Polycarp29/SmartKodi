<script setup>
import { ref, computed } from 'vue';
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import LargeCards from '../Components/Cards/LargeCards.vue';

const activeTab = ref('All');
const tabs = ['All', 'Unread', 'Financial', 'Maintenance', 'System'];

const notifications = ref([
    { 
        id: 1, 
        title: 'Rent Payment Received', 
        message: 'John Doe paid KES 45,000 via M-Pesa for Unit A12.', 
        time: '2 hours ago', 
        type: 'Financial', 
        read: false, 
        icon: 'fa-sack-dollar', 
        color: 'text-green-600', 
        bg: 'bg-green-50' 
    },
    { 
        id: 2, 
        title: 'Maintenance Request: Leaking Tap', 
        message: 'Tenant in Unit B04 reported a leaking tap in the kitchen.', 
        time: '5 hours ago', 
        type: 'Maintenance', 
        read: true, 
        icon: 'fa-wrench', 
        color: 'text-amber-600', 
        bg: 'bg-amber-50' 
    },
    { 
        id: 3, 
        title: 'System Backup Completed', 
        message: 'Daily system backup was completed successfully at 03:00 AM.', 
        time: '1 day ago', 
        type: 'System', 
        read: true, 
        icon: 'fa-server', 
        color: 'text-gray-600', 
        bg: 'bg-gray-50' 
    },
    { 
        id: 4, 
        title: 'Lease Expiry Warning', 
        message: 'Lease for Unit C09 is expiring in 30 days. Action required.', 
        time: '1 day ago', 
        type: 'Financial', 
        read: false, 
        icon: 'fa-file-invoice', 
        color: 'text-blue-600', 
        bg: 'bg-blue-50' 
    },
    { 
        id: 5, 
        title: 'New Tenant Registered', 
        message: 'Welcome message sent to new tenant Sarah Wilson (Unit E11).', 
        time: '2 days ago', 
        type: 'System', 
        read: true, 
        icon: 'fa-user-plus', 
        color: 'text-indigo-600', 
        bg: 'bg-indigo-50' 
    },
     { 
        id: 6, 
        title: 'Electricity Bill Alert', 
        message: 'Unusually high electricity consumption detected in Unit A05.', 
        time: '3 days ago', 
        type: 'Maintenance', 
        read: false, 
        icon: 'fa-bolt', 
        color: 'text-red-600', 
        bg: 'bg-red-50' 
    },
]);

const filteredNotifications = computed(() => {
    if (activeTab.value === 'All') return notifications.value;
    if (activeTab.value === 'Unread') return notifications.value.filter(n => !n.read);
    return notifications.value.filter(n => n.type === activeTab.value);
});

const unreadCount = computed(() => notifications.value.filter(n => !n.read).length);

const markAsRead = (id) => {
    const notification = notifications.value.find(n => n.id === id);
    if (notification) notification.read = true;
};

const deleteNotification = (id) => {
    notifications.value = notifications.value.filter(n => n.id !== id);
};

const markAllRead = () => {
    notifications.value.forEach(n => n.read = true);
};

</script>

<template>
    <DashboardLayout>
        <div class="space-y-6">
            <!-- Header -->
             <LargeCards>
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-black text-gray-800 tracking-tight">Notifications</h1>
                        <p class="text-sm font-medium text-gray-500 mt-1">
                            You have <span class="text-amber-600 font-bold">{{ unreadCount }} unread</span> notifications.
                        </p>
                    </div>
                    <button @click="markAllRead" class="px-5 py-2.5 bg-gray-50 hover:bg-amber-50 text-gray-600 hover:text-amber-600 text-sm font-bold rounded-xl transition-all border border-gray-200 hover:border-amber-200 flex items-center gap-2">
                        <i class="fa-solid fa-check-double"></i> Mark all read
                    </button>
                </div>
            </LargeCards>

            <!-- Content -->
            <div class="grid lg:grid-cols-4 gap-6">
                 <!-- Tabs Sidebar (Desktop) -->
                <div class="lg:col-span-1">
                     <LargeCards class="sticky top-24 p-2">
                        <nav class="space-y-1">
                            <button v-for="tab in tabs" :key="tab" 
                                @click="activeTab = tab"
                                :class="['w-full text-left px-4 py-3 rounded-xl text-sm font-bold transition-all flex items-center justify-between', activeTab === tab ? 'bg-amber-50 text-amber-600 shadow-sm' : 'text-gray-500 hover:bg-gray-50']">
                                <span>{{ tab }}</span>
                                <span v-if="tab === 'Unread' && unreadCount > 0" class="bg-red-500 text-white text-[10px] px-1.5 py-0.5 rounded-md min-w-[20px] text-center">{{ unreadCount }}</span>
                                <span v-if="tab === 'All'" class="bg-gray-100 text-gray-500 text-[10px] px-1.5 py-0.5 rounded-md">{{ notifications.length }}</span>
                            </button>
                        </nav>
                    </LargeCards>
                </div>

                <!-- Notifications List -->
                <div class="lg:col-span-3 space-y-4">
                    <LargeCards v-for="notification in filteredNotifications" :key="notification.id" 
                        :class="['transition-all duration-300 border-l-4', notification.read ? 'border-l-transparent bg-white' : 'border-l-amber-500 bg-amber-50/10']">
                        <div class="flex items-start gap-4">
                            <!-- Icon -->
                            <div :class="['w-12 h-12 rounded-xl flex items-center justify-center shrink-0 shadow-sm', notification.bg, notification.color]">
                                <i :class="['fa-solid text-xl', notification.icon]"></i>
                            </div>

                            <!-- Content -->
                            <div class="flex-1">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-1">
                                    <h3 class="text-base font-bold text-gray-800">{{ notification.title }}</h3>
                                    <span class="text-xs font-bold text-gray-400">{{ notification.time }}</span>
                                </div>
                                <p class="text-sm text-gray-600 leading-relaxed mb-3">{{ notification.message }}</p>
                                
                                <!-- Actions -->
                                <div class="flex items-center gap-4">
                                    <button v-if="!notification.read" @click="markAsRead(notification.id)" class="text-xs font-bold text-amber-600 hover:text-amber-700 transition-colors flex items-center gap-1">
                                        <i class="fa-solid fa-check"></i> Mark as read
                                    </button>
                                     <button @click="deleteNotification(notification.id)" class="text-xs font-bold text-gray-400 hover:text-red-500 transition-colors flex items-center gap-1">
                                        <i class="fa-regular fa-trash-can"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </LargeCards>

                    <!-- Empty State -->
                    <div v-if="filteredNotifications.length === 0" class="text-center py-20 bg-white rounded-2xl border border-gray-100 border-dashed">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto text-gray-400 mb-4">
                            <i class="fa-regular fa-bell-slash text-2xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">No notifications found</h3>
                        <p class="text-gray-500 mt-1">You're all caught up in this category.</p>
                    </div>
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>