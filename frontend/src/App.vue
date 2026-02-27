<template>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content">
            <!-- Navbar -->
            <router-view name="navbar"></router-view>
            <!-- Page content here -->
            <div class="z-1 relative">
                <router-view></router-view>
            </div>
        </div>

        <div class="drawer-side is-drawer-close:overflow-visible">
            <label
                for="my-drawer-4"
                aria-label="close sidebar"
                class="drawer-overlay"
            ></label>
            <div
                class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64"
            >
                <!-- Sidebar content here -->
                <router-view name="sidebar"></router-view>
            </div>
        </div>
        <router-view name="footer"></router-view>
    </div>
</template>


<script setup>
import { onMounted } from 'vue';
import { useThemeStore } from '@/stores/themeStore';

onMounted(() => {
  const themeStore = useThemeStore();

  // Initialize theme when app starts
  const savedTheme = localStorage.getItem('theme');

  if (savedTheme) {
    themeStore.setTheme(savedTheme);
  } else {
    // Check system preference
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    themeStore.setTheme(prefersDark ? 'dark' : 'light');
  }

  // Log current theme (for debugging)
  console.log('Theme initialized:', themeStore.currentTheme);
});
</script>

<style scoped></style>
