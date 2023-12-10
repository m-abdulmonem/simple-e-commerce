import Login from '../pages/Login.vue';
import Orders from "../pages/Orders.vue";
import Notifications from "../pages/Notifications.vue";

export default [
    {
        path: '/admin/orders',
        name: 'admin.orders',
        component: Orders,
    },
    {
        path: '/admin/login',
        name: 'admin.login',
        component: Login,
    },
    {
        path: '/admin/notifications',
        name: 'admin.notifications',
        component: Notifications,
    },
]
