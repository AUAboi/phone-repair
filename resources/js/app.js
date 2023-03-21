import './bootstrap';
import '../css/app.css';
import "@fontsource/jost/300.css"
import "@fontsource/jost/400.css"
import "@fontsource/jost/500.css"
import "@fontsource/jost/600.css"
import "@fontsource/jost/700.css"
import "@fontsource/jost/800.css"
import "@fontsource/jost/variable.css";

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createPinia } from 'pinia'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import PublicLayout from "@/Layouts/PublicLayout.vue"

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const pinia = createPinia()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async (name) => {
        const page = await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
        if (name.startsWith('Admin')) page.default.layout = AuthenticatedLayout
        if (name.startsWith('Public')) page.default.layout = PublicLayout
        return page;
    },
    progress: {
        showSpinner: true,
        color: "#dc2626"
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(pinia)
            .mount(el);
    },
});

