import { createI18n } from "vue-i18n";
import en from "../i18n/en/en";
import km from "../i18n/km/km";

const i18n = createI18n({
  legacy: false, // Use Composition API
  locale: "km", // Default language
  fallbackLocale: "km", // Fallback language
  messages: {
    km,
    en,
  },
});

export default i18n;
