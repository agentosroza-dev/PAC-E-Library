<template>
    <div class="min-h-screen bg-base-100">
        <!-- Page Header -->
        <div class="bg-base-200 shadow-sm border-b border-base-300 m-4 rounded-xl">
            <div class="container mx-auto px-4 py-4">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <h3 class="text-3xl font-bold bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent">
                            Dashboard
                        </h3>
                        <p class="text-base-content/70 text-sm mt-1">
                            Welcome back, {{ userData.name }}! Here's what's happening with your account.
                        </p>
                    </div>
                    <div class="text-sm breadcrumbs">
                        <ul>
                            <li class="flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                Home
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="container mx-auto px-4 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Users Card -->
                <div class="stat bg-base-200 rounded-xl shadow-sm border border-base-300 p-4">
                    <div class="stat-figure text-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </div>
                    <div class="stat-title">Total Users</div>
                    <div class="stat-value text-3xl text-primary">2,543</div>
                    <div class="stat-desc flex items-center gap-1 text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        +12% from last month
                    </div>
                </div>

                <!-- Revenue Card -->
                <div class="stat bg-base-200 rounded-xl shadow-sm border border-base-300 p-4">
                    <div class="stat-figure text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="stat-title">Revenue</div>
                    <div class="stat-value text-3xl text-secondary">$45.2K</div>
                    <div class="stat-desc flex items-center gap-1 text-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        +23% from last month
                    </div>
                </div>

                <!-- Active Sessions Card -->
                <div class="stat bg-base-200 rounded-xl shadow-sm border border-base-300 p-4">
                    <div class="stat-figure text-accent">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                            <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                        </svg>
                    </div>
                    <div class="stat-title">Active Sessions</div>
                    <div class="stat-value text-3xl text-accent">1,284</div>
                    <div class="stat-desc flex items-center gap-1 text-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        +5% from yesterday
                    </div>
                </div>

                <!-- Conversion Rate Card -->
                <div class="stat bg-base-200 rounded-xl shadow-sm border border-base-300 p-4">
                    <div class="stat-figure text-info">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <div class="stat-title">Conversion Rate</div>
                    <div class="stat-value text-3xl text-info">15.3%</div>
                    <div class="stat-desc flex items-center gap-1 text-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd" />
                        </svg>
                        -2% from last week
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Activity Section -->
        <div class="container mx-auto px-4 py-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Activity Chart -->
                <div class="bg-base-200 rounded-xl shadow-sm border border-base-300 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-bold text-lg">Activity Overview</h4>
                        <select class="select select-bordered select-sm bg-base-100">
                            <option>Last 7 days</option>
                            <option>Last 30 days</option>
                            <option>Last 3 months</option>
                        </select>
                    </div>
                    <div class="h-64 flex items-end justify-between gap-2">
                        <!-- Bar Chart Placeholder -->
                        <div class="flex flex-col items-center gap-2 w-full">
                            <div class="w-full flex items-end justify-around h-48">
                                <div class="w-8 bg-primary rounded-t-lg h-24 hover:h-32 transition-all"></div>
                                <div class="w-8 bg-primary rounded-t-lg h-32 hover:h-36 transition-all"></div>
                                <div class="w-8 bg-primary rounded-t-lg h-40 hover:h-44 transition-all"></div>
                                <div class="w-8 bg-primary rounded-t-lg h-28 hover:h-32 transition-all"></div>
                                <div class="w-8 bg-primary rounded-t-lg h-36 hover:h-40 transition-all"></div>
                                <div class="w-8 bg-primary rounded-t-lg h-44 hover:h-48 transition-all"></div>
                                <div class="w-8 bg-primary rounded-t-lg h-20 hover:h-24 transition-all"></div>
                            </div>
                            <div class="flex justify-around w-full text-xs text-base-content/70">
                                <span>Mon</span>
                                <span>Tue</span>
                                <span>Wed</span>
                                <span>Thu</span>
                                <span>Fri</span>
                                <span>Sat</span>
                                <span>Sun</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-base-200 rounded-xl shadow-sm border border-base-300 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-bold text-lg">Recent Activity</h4>
                        <button class="btn btn-ghost btn-sm">View All</button>
                    </div>
                    <div class="space-y-4">
                        <!-- Activity Item 1 -->
                        <div class="flex items-center gap-3 p-3 bg-base-100 rounded-lg">
                            <div class="avatar placeholder">
                                <div class="bg-primary text-primary-content rounded-full w-10">
                                    <span>JD</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm"><span class="font-bold">John Doe</span> created a new project</p>
                                <p class="text-xs text-base-content/50">2 minutes ago</p>
                            </div>
                            <span class="badge badge-primary badge-sm">New</span>
                        </div>

                        <!-- Activity Item 2 -->
                        <div class="flex items-center gap-3 p-3 bg-base-100 rounded-lg">
                            <div class="avatar placeholder">
                                <div class="bg-secondary text-secondary-content rounded-full w-10">
                                    <span>AS</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm"><span class="font-bold">Alice Smith</span> updated the profile</p>
                                <p class="text-xs text-base-content/50">15 minutes ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 3 -->
                        <div class="flex items-center gap-3 p-3 bg-base-100 rounded-lg">
                            <div class="avatar placeholder">
                                <div class="bg-accent text-accent-content rounded-full w-10">
                                    <span>RJ</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm"><span class="font-bold">Robert Johnson</span> completed a task</p>
                                <p class="text-xs text-base-content/50">1 hour ago</p>
                            </div>
                        </div>

                        <!-- Activity Item 4 -->
                        <div class="flex items-center gap-3 p-3 bg-base-100 rounded-lg">
                            <div class="avatar placeholder">
                                <div class="bg-info text-info-content rounded-full w-10">
                                    <span>EW</span>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm"><span class="font-bold">Emma Wilson</span> commented on post</p>
                                <p class="text-xs text-base-content/50">3 hours ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions and Tasks -->
        <div class="container mx-auto px-4 py-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Quick Actions -->
                <div class="bg-base-200 rounded-xl shadow-sm border border-base-300 p-6">
                    <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        Quick Actions
                    </h4>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="btn btn-outline btn-primary btn-sm gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                            </svg>
                            Add User
                        </button>
                        <button class="btn btn-outline btn-secondary btn-sm gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                            </svg>
                            New Report
                        </button>
                        <button class="btn btn-outline btn-accent btn-sm gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z" />
                            </svg>
                            Settings
                        </button>
                        <button class="btn btn-outline btn-info btn-sm gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2 5a2 2 0 012-2h7a2 2 0 012 2v4a2 2 0 01-2 2H9l-3 3v-3H4a2 2 0 01-2-2V5z" />
                                <path d="M15 7v2a4 4 0 01-4 4H9.828l-1.766 1.767c.28.149.599.233.938.233h2l3 3v-3h2a2 2 0 002-2V9a2 2 0 00-2-2h-1z" />
                            </svg>
                            Messages
                        </button>
                    </div>
                </div>

                <!-- Pending Tasks -->
                <div class="bg-base-200 rounded-xl shadow-sm border border-base-300 p-6">
                    <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-warning" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                        </svg>
                        Pending Tasks
                    </h4>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" />
                            <span class="text-sm flex-1">Review new user registrations</span>
                            <span class="badge badge-ghost badge-sm">12</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" checked />
                            <span class="text-sm flex-1 line-through text-base-content/50">Update profile information</span>
                            <span class="badge badge-success badge-sm">Done</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" />
                            <span class="text-sm flex-1">Generate monthly report</span>
                            <span class="badge badge-warning badge-sm">Due today</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="checkbox" class="checkbox checkbox-primary checkbox-sm" />
                            <span class="text-sm flex-1">Backup database</span>
                            <span class="badge badge-ghost badge-sm">Tomorrow</span>
                        </div>
                    </div>
                </div>

                <!-- System Health -->
                <div class="bg-base-200 rounded-xl shadow-sm border border-base-300 p-6">
                    <h4 class="font-bold text-lg mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        System Health
                    </h4>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>CPU Usage</span>
                                <span class="font-bold">45%</span>
                            </div>
                            <progress class="progress progress-primary w-full" value="45" max="100"></progress>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Memory Usage</span>
                                <span class="font-bold">62%</span>
                            </div>
                            <progress class="progress progress-secondary w-full" value="62" max="100"></progress>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Disk Space</span>
                                <span class="font-bold">78%</span>
                            </div>
                            <progress class="progress progress-accent w-full" value="78" max="100"></progress>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span>Network</span>
                                <span class="font-bold">98%</span>
                            </div>
                            <progress class="progress progress-success w-full" value="98" max="100"></progress>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import { useStore } from 'vuex'

const store = useStore()
const userData = computed(() => store.state.user || {})
</script>
