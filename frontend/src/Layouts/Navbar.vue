<template>
    <nav class="navbar w-full bg-base-300 z-1">
        <div class="flex-1">
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
            <router-link to="/" class="btn btn-ghost text-xl">{{
                $t("appname")
            }}</router-link>
        </div>

        <div class="flex gap-2">
            <!-- User Menu Dropdown -->
            <div class="dropdown dropdown-end">
                <div
                    tabindex="0"
                    role="button"
                    class="btn btn-ghost btn-circle avatar"
                >
                    <div class="w-10 rounded-full">
                        <img
                            :src="userPhoto || defaultAvatar"
                            :alt="userData?.name || 'User avatar'"
                        />
                    </div>
                </div>
                <ul
                    tabindex="-1"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow"
                >
                    <!-- Profile Link with Badge -->
                    <li>
                        <a class="flex items-center justify-between">
                            <span class="flex items-center gap-2">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                {{ userData?.name || "Profile" }}
                            </span>
                            <span class="badge badge-primary badge-sm"
                                >New</span
                            >
                        </a>
                    </li>

                    <!-- Settings Link -->
                    <li>
                        <router-link
                            to="/profile"
                            class="flex items-center gap-2"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            Settings
                        </router-link>
                    </li>

                    <div class="divider my-1"></div>

                    <!-- Logout Link -->
                    <li>
                        <router-link
                            to="/signout"
                            class="flex items-center gap-2 text-error"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4"
                                viewBox="0 0 20 20"
                                fill="currentColor"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                            Logout
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { computed } from "vue";
import { useStore } from "vuex";
import emptyPhoto from "@assets/images/emptyPhoto.png";

const store = useStore();

// Computed properties for user data
const userData = computed(() => store.state.user || {});
const userPhoto = computed(() => store.state.user?.photo || null);

// Default avatar fallback
const defaultAvatar = emptyPhoto;

// Optional: Handle logout directly
// const handleLogout = () => {
//     store.dispatch('logout')
// }
</script>

<style scoped>
/* Custom styles if needed */
.navbar {
    z-index: 50;
}

/* Optional: Animation for dropdown */
.dropdown-content {
    animation: fadeIn 0.2s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
