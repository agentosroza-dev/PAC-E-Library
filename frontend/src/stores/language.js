// stores/language.js
import { defineStore } from 'pinia';

export const useLanguageStore = defineStore('language', {
  state: () => ({
    currentLanguage: 'en',
    availableLanguages: [
      { code: 'en', name: 'English', nativeName: 'English', flag: '🇺🇸' },
      { code: 'km', name: 'Khmer', nativeName: 'ភាសាខ្មែរ', flag: '🇰🇭' }
    ],
    documentTitles: {
      en: 'AgEdit SuperApp',
      km: 'កម្មវិធីចំរុះ'
    },
    rtlLanguages: ['ar', 'he'], // For future RTL support
  }),

  getters: {
    getCurrentLanguage: (state) => state.currentLanguage,
    getDocumentTitle: (state) => (lang) => state.documentTitles[lang] || state.documentTitles.en,
    isRTL: (state) => state.rtlLanguages.includes(state.currentLanguage),
    currentLanguageDetails: (state) =>
      state.availableLanguages.find(lang => lang.code === state.currentLanguage),
    getLanguageByCode: (state) => (code) =>
      state.availableLanguages.find(lang => lang.code === code),
  },

  actions: {
    // Initialize language from localStorage
    initializeLanguage() {
      const savedLanguage = localStorage.getItem('user-language');
      const browserLanguage = navigator.language.split('-')[0];

      if (savedLanguage && this.isValidLanguage(savedLanguage)) {
        this.currentLanguage = savedLanguage;
      } else if (this.isValidLanguage(browserLanguage)) {
        this.currentLanguage = browserLanguage;
      }

      this.updateDocumentTitle();
      this.updateHtmlAttributes();
      return this.currentLanguage;
    },

    // Change language
    changeLanguage(lang) {
      if (this.isValidLanguage(lang)) {
        this.currentLanguage = lang;
        localStorage.setItem('user-language', lang);
        this.updateDocumentTitle();
        this.updateHtmlAttributes();
      }
    },

    // Update document title
    updateDocumentTitle() {
      document.title = this.documentTitles[this.currentLanguage] || this.documentTitles.en;
    },

    // Update HTML attributes (for RTL support)
    updateHtmlAttributes() {
      const html = document.documentElement;
      html.setAttribute('lang', this.currentLanguage);
      html.setAttribute('dir', this.isRTL ? 'rtl' : 'ltr');
    },

    // Validate language
    isValidLanguage(lang) {
      return lang === 'en' || lang === 'km' || this.availableLanguages.some(l => l.code === lang);
    }
  }
});
