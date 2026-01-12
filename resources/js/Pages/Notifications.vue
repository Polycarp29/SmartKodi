<script setup>
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import Navigations from '../Components/Common/Navigations.vue';
</script>
<template>
    <DashboardLayout>
        <Navigations></Navigations>
        <div class="notifications-container max-w-5xl mx-auto p-6 shadow-sm shadow-gray-100 bg-white rounded-md">
            <!-- Header with title and actions -->
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Notifications</h1>
                    <p class="text-gray-500 mt-1">Stay updated with your latest activities</p>
                </div>

                <div class="flex items-center space-x-3">
                    <!-- Search bar -->
                    <div class="relative">
                        <input type="text" placeholder="Search notifications..."
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 outline-none focus:border-amber-500 w-full md:w-64">
                        <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Filter dropdown -->
                    <div class="relative">
                        <button
                            class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                            </svg>
                            <span class="text-gray-700">Filter</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>

                    <!-- Mark all as read -->
                    <button class="px-4 py-2 bg-amber-50 text-amber-600 rounded-lg hover:bg-amber-100 font-medium">
                        Mark all as read
                    </button>
                </div>
            </div>

            <!-- Tabs -->
            <div class="flex border-b border-gray-200 mb-6">
                <button class="px-6 py-3 border-b-2 border-amber-500 text-amber-600 font-medium">
                    All
                </button>
                <button class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium relative">
                    Unread
                    <span
                        class="absolute top-2 right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                </button>
                <button class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium">
                    Archived
                </button>
                <button class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium">
                    Mentions
                </button>
            </div>

            <!-- Notifications list -->
            <div class="space-y-4">
                <!-- Unread notification -->
                <div class="flex items-start p-4 border border-gray-200 rounded-lg bg-amber-50">
                    <div class="flex-shrink-0 mr-4">
                        <div class="h-10 w-10 bg-amber-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between">
                            <h3 class="font-semibold text-gray-800">New message received</h3>
                            <span class="text-xs text-gray-500">2 hours ago</span>
                        </div>
                        <p class="text-gray-600 mt-1">You have a new message from <span class="font-medium">Sarah
                                Johnson</span> regarding the Unit 304 mantainance update.</p>
                        <div class="flex items-center space-x-3 mt-3">
                            <button class="text-sm text-amber-600 hover:text-amber-800 font-medium">Mark as read</button>
                            <button class="text-sm text-gray-500 hover:text-gray-700">Archive</button>
                        </div>
                    </div>
                </div>

                <!-- Read notification -->
                <div class="flex items-start p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <div class="flex-shrink-0 mr-4">
                        <div class="h-10 w-10 bg-amber-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between">
                            <h3 class="font-semibold text-gray-800">Task completed</h3>
                            <span class="text-xs text-gray-500">Yesterday</span>
                        </div>
                        <p class="text-gray-600 mt-1">Your task <span class="font-medium">"repairs on unit 4"</span> has been marked as completed.</p>
                    </div>
                </div>

                <!-- Mention notification -->
                <div class="flex items-start p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <div class="flex-shrink-0 mr-4">
                        <div class="h-10 w-10 bg-amber-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-amber-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between">
                            <h3 class="font-semibold text-gray-800">You were mentioned</h3>
                            <span class="text-xs text-gray-500">2 days ago</span>
                        </div>
                        <p class="text-gray-600 mt-1"><span class="font-medium">Alex Chen</span> mentioned you in a
                            comment on the design review.</p>
                        <div class="mt-2 text-sm text-amber-600 font-medium">View comment →</div>
                    </div>
                </div>

                <!-- System notification -->
                <div class="flex items-start p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <div class="flex-shrink-0 mr-4">
                        <div class="h-10 w-10 bg-gray-100 rounded-full flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex-grow">
                        <div class="flex justify-between">
                            <h3 class="font-semibold text-gray-800">System update scheduled</h3>
                            <span class="text-xs text-gray-500">1 week ago</span>
                        </div>
                        <p class="text-gray-600 mt-1">A system maintenance is scheduled for Saturday, 10:00 PM - 2:00
                            AM. Service may be temporarily unavailable.</p>
                    </div>
                </div>
            </div>

            <!-- Pagination or load more -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-center">
                <button class="px-5 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">
                    Load more notifications
                </button>
            </div>

            <!-- Empty state (hidden by default) -->
            <div class="hidden flex-col items-center justify-center py-12 text-center">
                <div class="h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-700 mb-2">No notifications</h3>
                <p class="text-gray-500 max-w-sm">You're all caught up! When you receive new notifications, they'll
                    appear here.</p>
            </div>
        </div>

    </DashboardLayout>
</template>