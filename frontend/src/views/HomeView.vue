<template>
    <div>
        <h1>{{ $t("appname") }}</h1>
        <p>
            Current language:
            {{ languageStore.currentLanguageDetails?.nativeName }}
        </p>
        <LanguageChanger />
    </div>
</template>

<script setup>
import LanguageChanger from "@/components/LanguageChanger.vue";
import { useLanguageStore } from "@/stores/language";

const languageStore = useLanguageStore();
</script>
