import { defineStore } from "pinia";
import { ref, computed, watch } from "vue";

export const useThemeStore = defineStore("theme", {
  state: () => ({
    // 当前主题
    currentTheme: localStorage.getItem("theme") || "agentos",

    // 所有可用的主题列表
    themes: [
      "agentos",
      "agentosdark",
      "police",
      "light",
      "dark",
      "cupcake",
      "bumblebee",
      "emerald",
      "corporate",
      "synthwave",
      "retro",
      "cyberpunk",
      "valentine",
      "halloween",
      "garden",
      "forest",
      "aqua",
      "lofi",
      "pastel",
      "fantasy",
      "wireframe",
      "black",
      "luxury",
      "dracula",
      "cmyk",
      "autumn",
      "business",
      "acid",
      "lemonade",
      "night",
      "coffee",
      "winter",
      "dim",
      "nord",
      "sunset",
      "caramellatte",
      "abyss",
      "silk",
    ],

    // 主题分组（可选，用于更好的组织）
    themeGroups: {
      light: [
        "light",
        "cupcake",
        "bumblebee",
        "emerald",
        "corporate",
        "lofi",
        "pastel",
        "fantasy",
        "wireframe",
      ],
      dark: [
        "dark",
        "synthwave",
        "retro",
        "cyberpunk",
        "halloween",
        "forest",
        "black",
        "dracula",
        "autumn",
        "night",
        "dim",
        "nord",
        "abyss",
      ],
      colored: [
        "valentine",
        "garden",
        "aqua",
        "luxury",
        "cmyk",
        "acid",
        "lemonade",
        "coffee",
        "winter",
        "sunset",
        "caramellatte",
        "silk",
      ],
      custom: ["agentos", "agentosdark", "police"],
    },

    // 是否显示主题选择器
    showThemeSelector: false,
  }),

  getters: {
    // 获取当前主题的友好名称
    currentThemeName: (state) => {
      const themeNames = {
        agentos: "Agentos",
        agentosdark: "AgentosDark",
        police: "police",
        light: "Light",
        dark: "Dark",
        cupcake: "Cupcake",
        bumblebee: "Bumblebee",
        emerald: "Emerald",
        corporate: "Corporate",
        synthwave: "Synthwave",
        retro: "Retro",
        cyberpunk: "Cyberpunk",
        valentine: "Valentine",
        halloween: "Halloween",
        garden: "Garden",
        forest: "Forest",
        aqua: "Aqua",
        lofi: "Lofi",
        pastel: "Pastel",
        fantasy: "Fantasy",
        wireframe: "Wireframe",
        black: "Black",
        luxury: "Luxury",
        dracula: "Dracula",
        cmyk: "CMYK",
        autumn: "Autumn",
        business: "Business",
        acid: "Acid",
        lemonade: "Lemonade",
        night: "Night",
        coffee: "Coffee",
        winter: "Winter",
        dim: "Dim",
        nord: "Nord",
        sunset: "Sunset",
        caramellatte: "Caramel Latte",
        abyss: "Abyss",
        silk: "Silk",
      };
      return themeNames[state.currentTheme] || state.currentTheme;
    },

    // 检查是否为深色主题
    isDarkTheme: (state) => {
      const darkThemes = [
        "dark",
        "synthwave",
        "retro",
        "cyberpunk",
        "halloween",
        "forest",
        "black",
        "dracula",
        "autumn",
        "night",
        "dim",
        "nord",
        "abyss",
        "agentosdark",
      ];
      return darkThemes.includes(state.currentTheme);
    },

    // 获取主题颜色预览
    themePreviewColors: () => {
      return {
        agentos: {
          base: "#ffffff",
          content: "oklch(13% 0.028 261.692)",
          primary: "oklch(70% 0.213 47.604)",
          secondary: "oklch(54% 0.245 262.881)",
          accent: "oklch(27% 0.077 45.635)",
        },

        agentosdark: {
          base: "#1f2937",
          content: "#f9fafb",
          primary: "#3b82f6",
          secondary: "#8b5cf6",
          accent: "#10b981",
        },
        // 可以继续添加其他主题的颜色定义
        police: {
          base: "#F2F2F2",
          content: "#f9fafb",
          primary: "#040DBF",
          secondary: "#F21D2F",
          accent: "#F2BE22",
        },
      };
    },
  },

  actions: {
    // 切换主题
    setTheme(themeName) {
      if (this.themes.includes(themeName)) {
        this.currentTheme = themeName;

        // 保存到 localStorage
        localStorage.setItem("theme", themeName);

        // 应用主题到 DOM
        this.applyThemeToDOM();

        // 触发自定义事件（可选，用于其他组件监听）
        window.dispatchEvent(
          new CustomEvent("theme-changed", {
            detail: { theme: themeName },
          })
        );
      }
    },

    // 应用主题到 DOM
    applyThemeToDOM() {
      document.documentElement.setAttribute("data-theme", this.currentTheme);

      // 如果使用 DaisyUI 的 theme-controller
      const themeController = document.querySelector(".theme-controller");
      if (themeController) {
        themeController.value = this.currentTheme;
      }
    },

    // 从 localStorage 加载主题
    loadTheme() {
      const savedTheme = localStorage.getItem("theme");
      if (savedTheme && this.themes.includes(savedTheme)) {
        this.setTheme(savedTheme);
      } else {
        // 默认主题
        this.setTheme("agentos");
      }
    },

    // 切换主题选择器的显示/隐藏
    toggleThemeSelector() {
      this.showThemeSelector = !this.showThemeSelector;
    },

    // 切换到下一个主题
    nextTheme() {
      const currentIndex = this.themes.indexOf(this.currentTheme);
      const nextIndex = (currentIndex + 1) % this.themes.length;
      this.setTheme(this.themes[nextIndex]);
    },

    // 切换到上一个主题
    previousTheme() {
      const currentIndex = this.themes.indexOf(this.currentTheme);
      const prevIndex =
        (currentIndex - 1 + this.themes.length) % this.themes.length;
      this.setTheme(this.themes[prevIndex]);
    },

    // 重置为默认主题
    resetTheme() {
      this.setTheme("agentos");
    },

    // 根据系统主题自动切换
    useSystemTheme() {
      const prefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)"
      ).matches;
      const defaultTheme = prefersDark ? "dark" : "light";
      this.setTheme(defaultTheme);
    },
  },
});
