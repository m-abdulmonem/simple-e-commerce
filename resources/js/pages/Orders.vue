<script setup>
import axios from 'axios';
import {useRouter} from 'vue-router';

const router = useRouter();
//
// const loading = ref(false);
//
const errorMessage = ref('');
const orders = ref('');
//
axios.get('/api/v1/orders', {
    headers: {
        'Authorization': `Bearer ${localStorage.getItem("token")}`
    }
})
    .then(response => {
        console.log(response)
        orders.value = response.data.data
    })
    .catch((error) => {
        if (error.data.msg === "Unauthenticated.") {
            router.push({name: 'admin.login'})
        }
        errorMessage.value = error.response.data.msg;
    })

const getProducts = cart => {
    return cart.items.map(item => `${item.product.name}  => Q: ${item.product.quantity}`).join("<br />")
}

</script>

<template>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Products => Quantity</th>
            <th>User</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="item in orders" :key="item.id">
            <td>{{ item.id }}</td>
            <td>{{getProducts(item.cart)}}</td>
            <td>{{ item.user.name }}</td>
            <td>{{ item.status }}</td>
        </tr>
        <!-- more rows... -->
        </tbody>
    </table>

</template>
