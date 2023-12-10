import './bootstrap';


import {createApp} from 'vue/dist/vue.esm-bundler';
import ChatMessages from './components/ChatMessages.vue';


const app = createApp({
    components: {
        ChatMessages,
    },
    data() {
        let messages;
        return { messages}
    },
    created() {
        this.fetchNotifications();
    },
    methods: {
        fetchNotifications() {
            axios.get('/messages').then(response => {
                this.auth = response.data.auth;
                this.messages = response.data;
            });

            window.Echo.private('notifications.1')
                .listen('MessageSent', (e) => {
                    console.log(e)
                    let a = this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });
                });
        },
        // addMessage(message) {
        //     const filter = new Filter();
        //     message.message = filter.clean(message.message)
        //     this.messages.push(message);
        //
        //     axios.post('/messages', message).then(response => {
        //         //response.data
        //     });
        // }
    }
}).mount("#app");
