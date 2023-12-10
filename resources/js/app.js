

// import { createApp } from 'vue';

// const app = createApp({});
//
// import ExampleComponent from './components/ExampleComponent.vue';
// app.component('example-component', ExampleComponent);

// // Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
// //     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// // });

// app.mount('#app');
import './bootstrap';
import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { createRouter, createWebHistory } from 'vue-router';
import Routes from './routers/routes.js';
import App from './App.vue';
import { useAuthUserStore } from './stores/AuthUserStore';

const pinia = createPinia();
const app = createApp(App);

const router = createRouter({
    routes: Routes,
    history: createWebHistory(),
});

router.beforeEach(async (to, from, next) => {
    const authUserStore = useAuthUserStore();
    if (to.matched.some(record => record.meta.requiresAuth)) {

        if (!authUserStore.user.token) {
            next({ name: 'admin.login' })
        } else {
            next()
        }
    } else {
        next()
    }
})
//
// import SocketIO from 'vue-socket.io'
// import { io } from 'socket.io-client'

// const socket = io('http://localhost:3000',{
//     rejectUnauthorized: false
// })
// socket.on('notifications', (notif) => {
//     console.log(notif)
// });
// app.use(new SocketIO({
//     connection: 'https://localhost:9001' //options object is Optional
// }));
app.use(pinia);
app.use(router);
app.mount('#app');
