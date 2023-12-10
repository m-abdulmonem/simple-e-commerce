<script setup>
import axios from 'axios';
import {useRouter} from 'vue-router';

const router = useRouter();

const errorMessage = ref('');
const notifications = ref('');

axios.get('/api/v1/notifications', {
    headers: {
        'Authorization': `Bearer ${localStorage.getItem("token")}`
    }
})
    .then(response => {
        console.log(response)
        notifications.value = response.data.data
    })
    .catch((error) => {
        if (error.data.msg === "Unauthenticated.") {
            router.push({name: 'admin.login'})
        }
        errorMessage.value = error.response.data.msg;
    })


</script>

<template>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Title</th>
            <th>Order Id</th>
            <th>Is Read</th>
        </tr>
        </thead>
        <tbody id="notification-table">
        <tr v-for="item in notifications" :key="item.id">
            <td>{{ item.title }}</td>
            <td>#{{ item.order_id }}</td>
            <td>{{ item.is_read ? 'Yes' : 'no' }}</td>
        </tr>
        <!-- more rows... -->
        </tbody>
    </table>

</template>
