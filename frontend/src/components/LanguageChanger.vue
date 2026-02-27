<template>
  <div title="Change Languages" class="dropdown dropdown-top":class="droplocation">
    <div
      tabindex="0"
      role="button"
      class="btn group btn-sm gap-1.5 px-1.5 btn-ghost"
      aria-label="Change Languages"
    >
      <div
        class="bg-base-100 group-hover:border-base-content/20 border-base-content/10 grid shrink-0 grid-cols-1 rounded-md border p-1 transition-colors"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="1.3em"
          height="1.3em"
          viewBox="0 0 24 24"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
          class="icon icon-tabler icons-tabler-outline icon-tabler-language-hiragana"
        >
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M4 5h7" />
          <path d="M7 4c0 4.846 0 7 .5 8" />
          <path
            d="M10 8.5c0 2.286 -2 4.5 -3.5 4.5s-2.5 -1.135 -2.5 -2c0 -2 1 -3 3 -3s5 .57 5 2.857c0 1.524 -.667 2.571 -2 3.143"
          />
          <path d="M12 20l4 -9l4 9" />
          <path d="M19.1 18h-6.2" />
        </svg>
      </div>
    </div>

    <!-- Dropdown Content -->
    <div
      tabindex="0"
      class="dropdown-content bg-base-200 rounded-field shadow-2xl border-base-300 overflow-y-auto h-auto"
    >
      <ul class="menu w-52">
        <li
          class="grow font-black text-center text-base-content mb-1 text-shadow-lg"
        >
          <span class="flex flex-row justify-center">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              width="1.3em"
              height="1.3em"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="1.5"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="icon icon-tabler icons-tabler-outline icon-tabler-language"
            >
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <path d="M9 6.371c0 4.418 -2.239 6.629 -5 6.629" />
              <path d="M4 6.371h7" />
              <path d="M5 9c0 2.144 2.252 3.908 6 4" />
              <path d="M12 20l4 -9l4 9" />
              <path d="M19.1 18h-6.2" />
              <path d="M6.694 3l.793 .582" />
            </svg>
              {{ $t("languages") }}
          </span>
        </li>
        <li></li>
        <li>
          <button
            @click="handleLanguageChange('en')"
            :class="{ 'active-language': languageStore.currentLanguage === 'en' }"
            class="w-full text-left"
          >
            <span
              class="pe-4 font-mono text-[.5625rem] font-bold tracking-[0.09375rem] opacity-40"
              >EN</span
            >
            <span class="font-[sans-serif]">English</span>
            <svg
              v-if="languageStore.currentLanguage === 'en'"
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="check-icon"
            >
              <path d="M20 6L9 17l-5-5" />
            </svg>
          </button>
        </li>
        <li>
          <button
            @click="handleLanguageChange('km')"
            :class="{ 'active-language': languageStore.currentLanguage === 'km' }"
            class="w-full text-left"
          >
            <span
              class="pe-4 font-mono text-[.5625rem] font-bold tracking-[0.09375rem] opacity-40"
              >KM</span
            >
            <span class="font-[sans-serif]">Khmer</span>
            <svg
              v-if="languageStore.currentLanguage === 'km'"
              xmlns="http://www.w3.org/2000/svg"
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              class="check-icon"
            >
              <path d="M20 6L9 17l-5-5" />
            </svg>
          </button>
        </li>
      </ul>
    </div>
  </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import { onMounted, watch } from "vue";
import { storeToRefs } from 'pinia';
import { useLanguageStore } from "@/stores/language"; // Adjust the import path as needed

const props = defineProps({
  droplocation: {
    type: String,
    default: ''
  }
});

// Initialize stores
const languageStore = useLanguageStore();
const { locale } = useI18n();

// Use storeToRefs to maintain reactivity
const { currentLanguage } = storeToRefs(languageStore);

// Initialize language on component mount
onMounted(() => {
  const savedLang = languageStore.initializeLanguage();
  locale.value = savedLang;
});

// Watch for store changes and update i18n locale
watch(
  () => languageStore.currentLanguage,
  (newLang) => {
    locale.value = newLang;
  }
);

// Handle language change
const handleLanguageChange = (lang) => {
  languageStore.changeLanguage(lang);
  locale.value = lang; // Ensure i18n is updated
};

// Note: The following props appear to be used in the template but aren't defined in the script
// You'll need to define these based on your TextGradientAnimation component requirements:
// animationClass, gradientStyle, pauseAnimation, resumeAnimation

// Example if these are props:
// defineProps({
//   animationClass: String,
//   gradientStyle: Object,
//   pauseAnimation: Function,
//   resumeAnimation: Function
// })
</script>

<style lang="css" scoped>
.check-icon {
  margin-left: auto;
}

/* Optional: Add hover effect for better UX */
button:hover {
  background-color: rgba(0, 0, 0, 0.05);
}

.active-language {
  background-color: rgba(0, 123, 255, 0.1);
  font-weight: 600;
}
</style>
