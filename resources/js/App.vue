<script setup>


import {useAuthUserStore} from './stores/AuthUserStore';
import {useRouter} from 'vue-router';

const router = useRouter();
const authUserStore = useAuthUserStore();

const logout = () => {
  localStorage.clear();
  router.push({name: "admin.login"})
}

let channel = window.Echo.channel('notifications');
channel.listen('.my-event', function (e) {
  alert(e.details.title)
  let table = document.getElementById("notification-table");

  if (table) {
    let newRow = table.insertRow(0);
    let newCell1 = newRow.insertCell(0);
    let newCell2 = newRow.insertCell(1);
    let newCell3 = newRow.insertCell(2);
    newCell1.innerHTML = e.details.title;
    newCell2.innerHTML = "#" + e.details.order_id;
    newCell3.innerHTML = "No";
  }
});

</script>

<template>
  <div class="wrapper">
    <div v-if="authUserStore.user.token !== ''">
      <ul>
        <li>
          <router-link to="/admin/notifications">Notifications</router-link>
        </li>
        <li>
          <router-link to="/admin/orders">Orders</router-link>
        </li>
        <li>

          <a href="#" @click="logout">Logout</a>
        </li>
      </ul>
    </div>
    <div class="content-wrapper">
      <router-view></router-view>
    </div>
    <!-- footer -->
  </div>
</template>
