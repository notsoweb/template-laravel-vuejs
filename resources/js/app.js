import '../css/app.css';
import './bootstrap';
import './broadcastGlobalEvents';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import Notify from '@/notify';
import Swal from 'sweetalert2'
import {i18n, t} from '@/Lang/i18n';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

window.appName = appName;
window.lang = t;
window.Notify = new Notify();
window.Swal = Swal;

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ 
                render: () => h(app, props) 
            })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(i18n)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
