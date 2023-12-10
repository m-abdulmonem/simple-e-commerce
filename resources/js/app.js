import './bootstrap';


import {createApp} from 'vue/dist/vue.esm-bundler';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';
import UsersList from './components/UsersList.vue';
import ChatClone from './components/ChatClone.vue';
import Filter from 'bad-words';


const app = createApp({
    components: {
        ChatMessages,
        ChatForm,
        UsersList,
        ChatClone
    },
    data() {
        let messages;
        return { messages}
    },
    created() {
        this.fetchMessages();
    },
    methods: {
        fetchMessages() {
            axios.get('/messages').then(response => {
                this.auth = response.data.auth;
                this.messages = response.data;
            });

            window.Echo.private('chat')
                .listen('MessageSent', (e) => {
                    let a = this.messages.push({
                        message: e.message.message,
                        user: e.user
                    });
                });
        },
        addMessage(message) {
            const filter = new Filter();
            message.message = filter.clean(message.message)
            this.messages.push(message);

            axios.post('/messages', message).then(response => {
                //response.data
            });
        }
    }
}).mount("#app");
