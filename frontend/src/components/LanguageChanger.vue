<template>
  <div class="dropdown dropdown-top dropdown-end">
    <!-- Trigger Button with Flag -->
    <label tabindex="0" class="btn btn-sm btn-soft btn-primary gap-2">
      <span class="text-lg">{{ currentLanguageFlag }}</span>
      <span class="hidden sm:inline">{{ currentLanguageName }}</span>
        
    </label>

    <!-- Dropdown Content -->
    <ul tabindex="0" class="dropdown-content menu bg-base-100 rounded-box shadow-xl border border-base-200 w-56 p-2 z-50">
      <li class="menu-title">
        <span class="text-base-content/70">{{ $t("select_language") }}</span>
      </li>

      <li v-for="lang in languages" :key="lang.code">
        <button
          @click="handleLanguageChange(lang.code)"
          :class="{ 'active': languageStore.currentLanguage === lang.code }"
          class="flex items-center justify-between"
        >
          <span class="flex items-center gap-3">
            <span class="text-xl">{{ lang.flag }}</span>
            <div class="flex flex-col items-start">
              <span>{{ lang.name }}</span>
              <span class="text-xs opacity-60">{{ lang.nativeName }}</span>
            </div>
          </span>
          <span v-if="languageStore.currentLanguage === lang.code" class="text-primary">
          </span>
        </button>
      </li>

    </ul>
  </div>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import { onMounted, watch, computed } from "vue";
import { useLanguageStore } from "@/stores/language";

// Initialize stores
const languageStore = useLanguageStore();
const { locale } = useI18n();

// Languages data
const languages = [
  { code: 'en', name: 'English', nativeName: 'English', flag: '🇺🇸' },
  { code: 'km', name: 'Khmer', nativeName: 'ភាសាខ្មែរ', flag: '🇰🇭' }
];

// Computed properties for current language
const currentLanguageFlag = computed(() => {
  return languages.find(l => l.code === languageStore.currentLanguage)?.flag || '🇺🇸';
});

const currentLanguageName = computed(() => {
  return languages.find(l => l.code === languageStore.currentLanguage)?.name || 'English';
});

// Initialize language on component mount
onMounted(() => {
  const savedLang = languageStore.initializeLanguage();
  locale.value = savedLang;
});

// Watch for store changes
watch(
  () => languageStore.currentLanguage,
  (newLang) => {
    locale.value = newLang;
  },
  { immediate: true }
);

// Handle language change
const handleLanguageChange = (lang) => {
  if (lang === languageStore.currentLanguage) return;
  languageStore.changeLanguage(lang);
  locale.value = lang;
};
</script>
