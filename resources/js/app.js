import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import '../css/app.css';

createInertiaApp({
    resolve: name => {
        return import(`./Pages/${name}.vue`).then(module => module.default);
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });
        app.use(plugin);
        app.mount(el);
    },
});