import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import VueTelInput from 'vue-tel-input';
import 'vue-tel-input/vue-tel-input.css';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

const globalOptions = {
    mode: 'auto',
};

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use((VueTelInput, globalOptions))
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
