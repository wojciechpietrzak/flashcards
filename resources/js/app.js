import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

import { createI18n } from 'vue-i18n';
import en from './locales/en.json'; // English translations (you can add more languages here)
import pl from './locales/pl.json'; // Polish translations (if available)
import de from './locales/de.json'; // German translations (if available)

const i18n = createI18n({
  legacy: false, // Use Composition API
  locale: 'en', // Default language (you can change this based on user's selection)
  messages: {
    en,
    pl,
    de,
  },
});

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(i18n)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

/*const i18n = createI18n({
    legacy: false, // Make sure to use the composition API (if you are using Vue 3)
    locale: document.documentElement.lang || 'en', // Default language based on the HTML lang attribute
    messages: {
      en: {
        // Your English translations here
        dashboard: 'Dashboard',
        logout: 'Log Out',
        profile: 'Profile',
        welcome: 'Welcome',
      },
      pl: {
        // Polish translations
        dashboard: 'Panel',
        logout: 'Wyloguj się',
        profile: 'Profil',
        welcome: 'Witaj',
      },
      de: {
        // German translations
        dashboard: 'Dashboard',
        logout: 'Ausloggen',
        profile: 'Profil',
        welcome: 'Willkommen',
      }
    }
  });*/
