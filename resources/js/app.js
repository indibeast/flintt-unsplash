import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';

createInertiaApp({
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
       const vue =  createApp({ render: () => h(App, props) })
        vue.use(plugin)
        vue.mixin({ methods: { route } })
        vue.mount(el)

    },
});
