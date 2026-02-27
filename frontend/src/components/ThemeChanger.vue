<template>
    <div
        title="Change Themes"
        class="dropdown dropdown-top"
        :class="droplocation"
    >
        <!-- 触发按钮 -->
        <div
            tabindex="0"
            role="button"
            class="btn group btn-sm gap-1.5 px-1.5 btn-ghost"
            aria-label="Change Themes"
        >
            <div
                class="bg-base-100 group-hover:border-base-content/20 border-base-content/10 grid gap-0.5 shrink-0 grid-cols-2 rounded-md border p-1 transition-colors"
            >
                <div class="bg-base-content size-1.5 rounded-full"></div>
                <div class="bg-primary size-1.5 rounded-full"></div>
                <div class="bg-secondary size-1.5 rounded-full"></div>
                <div class="bg-accent size-1.5 rounded-full"></div>
            </div>
        </div>

        <!-- 下拉菜单 -->
        <div
            tabindex="0"
            class="dropdown-content bg-base-200 rounded-field shadow-2xl border-base-300 overflow-y-auto h-100 z-100"
        >
            <ul class="menu w-52">
                <li
                    class="grow font-black text-center text-base-content mb-1 text-shadow-lg"
                >
                    <span
                        >👀
                        {{ t("selectThemes") }}
                    </span>
                </li>

                <!-- 动态生成主题列表 -->
                <li v-for="themeName in themeStore.themes" :key="themeName">
                    <button
                        class="gap-3 px-2"
                        @click="themeStore.setTheme(themeName)"
                        :data-set-theme="themeName"
                    >
                        <label
                            class="flex cursor-pointer items-center gap-1 px-1"
                            :class="{
                                '[&_svg]:visible':
                                    themeStore.currentTheme === themeName,
                            }"
                        >
                            <!-- 主题颜色预览 -->
                            <div
                                class="grid shrink-0 grid-cols-2 gap-0.5 rounded-md p-1 shadow-sm"
                                :data-theme="themeName"
                                :class="{
                                    'bg-base-100':
                                        themeName !== 'agentos' &&
                                        themeName !== 'agentosdark',
                                }"
                                :style="getThemeStyle(themeName)"
                            >
                                <div
                                    class="size-1 rounded-full"
                                    :class="
                                        themeName === 'agentos' ||
                                        themeName === 'agentosdark'
                                            ? ''
                                            : 'bg-base-content'
                                    "
                                    :style="getDotStyle(themeName, 'content')"
                                ></div>
                                <div
                                    class="size-1 rounded-full"
                                    :class="
                                        themeName === 'agentos' ||
                                        themeName === 'agentosdark'
                                            ? ''
                                            : 'bg-primary'
                                    "
                                    :style="getDotStyle(themeName, 'primary')"
                                ></div>
                                <div
                                    class="size-1 rounded-full"
                                    :class="
                                        themeName === 'agentos' ||
                                        themeName === 'agentosdark'
                                            ? ''
                                            : 'bg-secondary'
                                    "
                                    :style="getDotStyle(themeName, 'secondary')"
                                ></div>
                                <div
                                    class="size-1 rounded-full"
                                    :class="
                                        themeName === 'agentos' ||
                                        themeName === 'agentosdark'
                                            ? ''
                                            : 'bg-accent'
                                    "
                                    :style="getDotStyle(themeName, 'accent')"
                                ></div>
                            </div>

                            <!-- 主题名称 -->
                            <div class="w-32 truncate">
                                {{ getDisplayThemeName(themeName) }}
                            </div>

                            <!-- 选中图标 -->
                            <svg
                                v-show="themeStore.currentTheme === themeName"
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="currentColor"
                                class="h-3 w-3 shrink-0"
                            >
                                <path
                                    d="M20.285 2l-11.285 11.567-5.286-5.011-3.714 3.716 9 8.728 15-15.285z"
                                />
                            </svg>

                            <!-- Radio Input -->
                            <input
                                type="radio"
                                name="theme-radios"
                                class="radio radio-sm theme-controller hidden"
                                :value="themeName"
                                :checked="themeStore.currentTheme === themeName"
                                @change="themeStore.setTheme(themeName)"
                            />
                        </label>
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import { useThemeStore } from "@/stores/themeStore";
import { onMounted } from "vue";
const props = defineProps({
    droplocation: {
        type: String,
        default: "",
    },
});
// 使用 Pinia stores - 重命名 themeStore 以避免混淆
const themeStore = useThemeStore();

import { useI18n } from "vue-i18n";
const { t } = useI18n({
    legacy: false,
    locale: "km",
    fallbackLocale: "km",
    messages: {
        en: {
            themes: "Themes",
            selectThemes: "Select Themes",
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
            agentos: "AgentOS",
            agentosdark: "AgentOS Dark",
            police: "Police",
        },
        km: {
            themes: "ផ្ទៃពណ៍",
            selectThemes: "ជ្រើសរើសផ្ទៃពណ៍",
            light: "ពន្លឺ",
            dark: "ងងឹត",
            cupcake: "នំប៉័ង",
            bumblebee: "ឃ្មុំ",
            emerald: "ពេជ្រ",
            corporate: "កូពេរ៉ា",
            synthwave: "ស៊ីវេវ",
            retro: "រីត្រូ",
            cyberpunk: "សាយប័រផាំង",
            valentine: "វាលែនទិន",
            halloween: "ហាឡូវីន",
            garden: "សួន",
            forest: "ព្រៃ",
            aqua: "អេខ្វរ",
            lofi: "លូហ្វី",
            pastel: "ផាស់តាល់",
            fantasy: "ហ្វេនស៊ី",
            wireframe: "ភ្លើងក្រហម",
            black: "ខ្មៅ",
            luxury: "ផ្ទះល្វែង",
            dracula: "ត្រាកូឡា",
            cmyk: "CMYK",
            autumn: "ស្លឹកឈើជ្រុះ",
            business: "អាជីវកម្ម",
            acid: "អស៊ីត",
            lemonade: "ក្រូចឆ្មា",
            night: "យប់",
            coffee: "កាហ្វេ",
            winter: "រដូវរងា",
            dim: "ស្រាល",
            nord: "ណរ",
            sunset: "ថ្ងៃលិច",
            caramellatte: "ខារ៉ាមែលឡាតែ",
            abyss: "អាបីស",
            silk: "សូត្រ",
            agentos: "អេចេនតូស",
            agentosdark: "អេចនតូស Dark",
            police: "នគរបាល",
        },
    },
});

// 获取显示的主题名称
const getDisplayThemeName = (themeName) => {
    // 直接使用 t 函数，它会根据键名查找对应的翻译
    // 如果主题名称不在翻译中，返回主题名称本身
    const translation = t(themeName);
    return translation !== themeName ? translation : themeName;
};

// 获取主题样式
const getThemeStyle = (themeName) => {
    if (themeName === "agentos") {
        return { backgroundColor: "oklch(0.98 0 0)" };
    } else if (themeName === "agentosdark") {
        return { backgroundColor: "oklch(0.14 0.004 49.25)" };
    }
    return {};
};

// 获取圆点样式
const getDotStyle = (themeName, type) => {
    const styles = {
        agentos: {
            content: { backgroundColor: "oklch(0.2 0 0)" },
            primary: { backgroundColor: "oklch(0.83 0.128 66.29)" },
            secondary: { backgroundColor: "oklch(0.8 0.105 251.813)" },
            accent: { backgroundColor: "oklch(0.9 0.182 98.111)" },
        },
        agentosdark: {
            content: { backgroundColor: "oklch(0.97 0.001 106.424)" },
            primary: { backgroundColor: "oklch(0.82 0.119 306.383)" },
            secondary: { backgroundColor: "oklch(0.8 0.105 251.813)" },
            accent: { backgroundColor: "oklch(0.87 0.169 91.605)" },
        },
    };
    return styles[themeName]?.[type] || {};
};

// 组件挂载时加载主题
onMounted(() => {
    themeStore.loadTheme();
});
</script>
