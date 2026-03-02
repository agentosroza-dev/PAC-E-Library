<template>
    <!-- Sidebar content here -->
    <div
        class="flex flex-col h-dvh w-full rounded-xl justify-content-between items-left border-r border-base-300"
    >
        <div class="p-4 border-b border-base-300">
            <div class="flex items-center gap-3 is-drawer-close:justify-center">
                <div class="relative group">
                    <!-- Animated Logo -->
                    <div
                        class="w-10 h-10 bg-linear-to-br from-primary to-secondary rounded-xl shadow-lg flex items-center justify-center transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-3"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            stroke-linejoin="round"
                            stroke-linecap="round"
                            stroke-width="1.5"
                            fill="none"
                            stroke="white"
                            class="w-5 h-5"
                        >
                            <path
                                d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"
                            ></path>
                            <path
                                d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                            ></path>
                        </svg>
                    </div>
                    <!-- Glow Effect -->
                    <div
                        class="absolute -inset-1 bg-linear-to-r from-primary/20 to-secondary/20 rounded-xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                    ></div>
                </div>
                <span
                    class="font-bold text-lg is-drawer-close:hidden bg-linear-to-r from-primary to-secondary bg-clip-text text-transparent"
                >
                    AppName
                </span>
            </div>
        </div>
        <ul class="menu grow gap-2 p-2 w-full">
            <!-- Homepage item with router-link -->
            <li class="w-full">
                <router-link
                    to="/home"
                    class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="Home"
                    :class="{ 'menu-active': $route.path === '/home' }"
                >
                    <!-- Home icon -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2"
                        fill="none"
                        stroke="currentColor"
                        class="size-4"
                    >
                        <path
                            d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"
                        ></path>
                        <path
                            d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"
                        ></path>
                    </svg>
                    <span class="is-drawer-close:hidden">Homepage</span>
                </router-link>
            </li>
            <li class="w-full">
                <router-link
                    to="/pdfbook"
                    class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="Pdfbook"
                    :class="{ 'menu-active': $route.path === '/pdfbook' }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                        <path d="M17 18h2" />
                        <path d="M20 15h-3v6" />
                        <path
                            d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1"
                        />
                    </svg>
                    <span class="is-drawer-close:hidden">EBook</span>
                </router-link>
            </li>
            <li class="w-full">
                <router-link
                    to="/favorites"
                    class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="favorites"
                    :class="{ 'menu-active': $route.path === '/favorites' }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-table-heart"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M11.5 21h-6.5a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6"
                        />
                        <path d="M3 10h18" />
                        <path d="M10 3v18" />
                        <path
                            d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296"
                        />
                    </svg>
                    <span class="is-drawer-close:hidden">Your Fevorites</span>
                </router-link>
            </li>
            <!-- Dashboard item with router-link -->
            <li class="w-full" v-show="userLevel === 'admin'">
                <router-link
                    to="/dashboard"
                    class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="Dashboard"
                    :class="{ 'menu-active': $route.path === '/dashboard' }"
                >
                    <!-- Home icon -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-dashboard"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 13a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                        <path d="M13.45 11.55l2.05 -2.05" />
                        <path d="M6.4 20a9 9 0 1 1 11.2 0l-11.2 0" />
                    </svg>
                    <span class="is-drawer-close:hidden">Dashboard</span>
                </router-link>
            </li>

            <!-- About item with router-link -->
            <li>
                <router-link
                    to="/about"
                    class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="About"
                    :class="{ 'menu-active': $route.path === '/about' }"
                >
                    <!-- About icon (info circle) -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2"
                        fill="none"
                        stroke="currentColor"
                        class="size-4"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M12 9h.01" />
                        <path d="M11 12h1v4h1" />
                    </svg>
                    <span class="is-drawer-close:hidden">About</span>
                </router-link>
            </li>

            <!-- Settings item with router-link -->
            <li>
                <router-link
                    to="/profile"
                    class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="Settings"
                    :class="{ 'menu-active': $route.path === '/profile' }"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2"
                        fill="none"
                        stroke="currentColor"
                        class="size-4"
                    >
                        <path d="M20 7h-9"></path>
                        <path d="M14 17H5"></path>
                        <circle cx="17" cy="17" r="3"></circle>
                        <circle cx="7" cy="7" r="3"></circle>
                    </svg>
                    <span class="is-drawer-close:hidden">Settings</span>
                </router-link>
            </li>

            <!-- DaisyUI Divider -->
            <li class="menu-title is-drawer-close:hidden">
                <span class="text-xs opacity-60">MORE</span>
            </li>

            <!-- Help item (optional) -->
            <li>
                <router-link
                    to="/help"
                    class="is-drawer-close:tooltip is-drawer-close:tooltip-right"
                    data-tip="Help"
                    :class="{ 'menu-active': $route.path === '/help' }"
                >
                    <!-- Help icon -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2"
                        fill="none"
                        stroke="currentColor"
                        class="size-4"
                    >
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                        <path d="M12 16v.01" />
                        <path
                            d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"
                        />
                    </svg>
                    <span class="is-drawer-close:hidden">Help</span>
                </router-link>
            </li>
        </ul>

        <ul
            class="flex gap-2 flex-col flex-nowrap justify-end is-drawer-close:items-center content-end p-2"
        >
            <li>
                <LanguageChanger />
            </li>
            <li>
                <ThemeChanger />
            </li>
            <li>
                <label
                    for="my-drawer-4"
                    aria-label="open sidebar"
                    class="btn btn-square btn-ghost"
                >
                    <!-- Sidebar toggle icon -->
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        stroke-linejoin="round"
                        stroke-linecap="round"
                        stroke-width="2"
                        fill="none"
                        stroke="currentColor"
                        class="my-1.5 inline-block size-4"
                    >
                        <path
                            d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"
                        ></path>
                        <path d="M9 4v16"></path>
                        <path d="M14 10l2 2l-2 2"></path>
                    </svg>
                </label>
            </li>
        </ul>
    </div>
</template>

<script setup>
import LanguageChanger from "@/components/LanguageChanger.vue";
import ThemeChanger from "@/components/ThemeChanger.vue";
import { useRoute } from "vue-router";
import { computed } from "vue";
import { useStore } from "vuex";
// Optional: Get current route for more complex conditions
const route = useRoute();
const store = useStore();

// Computed properties for user data

const userLevel = computed(() => store.state.user?.level || null);

// You can also create computed properties for active states
// if you need more complex matching logic
</script>
