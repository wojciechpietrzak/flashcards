<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { useI18n } from 'vue-i18n';

const { locale } = useI18n();

// List of available languages (can also be fetched from an API if preferred)
const availableLanguages = ref([]);

// Load languages from API on mount
const fetchLanguages = async () => {
    try {
        const response = await fetch('/api/languages'); // Adjust the endpoint if necessary
        availableLanguages.value = await response.json();
    } catch (error) {
        console.error('Failed to fetch languages:', error);
    }
};

// Handle language selection
const selectedLanguage = ref(localStorage.getItem('selectedLanguage') || locale.value);

const changeLanguage = (lang) => {
    selectedLanguage.value = lang;
    locale.value = lang;
    localStorage.setItem('selectedLanguage', lang);
};

// Sync the language from `localStorage` on mount
onMounted(() => {
    fetchLanguages();

    if (localStorage.getItem('selectedLanguage')) {
        locale.value = localStorage.getItem('selectedLanguage');
    }
});
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </Link>
        </div>

        <!-- Language Selector -->
        <div class="mt-4">
            <label for="language-selector" class="block text-sm font-medium text-gray-700">
                {{ $t('Language') }}
            </label>
            <select
                id="language-selector"
                v-model="selectedLanguage"
                @change="changeLanguage(selectedLanguage)"
                class="mt-1 block w-24 px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            >
                <option
                    v-for="lang in availableLanguages"
                    :key="lang.code"
                    :value="lang.code"
                >
                    {{ lang.name }}
                </option>
            </select>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
