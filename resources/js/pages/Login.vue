<script setup>
import axios from 'axios';
import {reactive, ref} from 'vue';
import {useRouter} from 'vue-router';
import {useAuthUserStore} from '../stores/AuthUserStore';

const authUserStore = useAuthUserStore();
const router = useRouter();
const form = reactive({
    auth: '',
    password: '',
});

const loading = ref(false);

const errorMessage = ref('');
const handleSubmit = () => {
    loading.value = true;
    errorMessage.value = '';
    axios.post('/api/v1/login', form)
        .then(response => {
            const data = response.data.data;
            if(data.is_admin){
                authUserStore.setAuthUser(data);

                router.push({ name: 'admin.orders' });
                location.reload();
            }else {
                errorMessage.value = "Account not found";
            }
        })
        .catch((error) => {
            errorMessage.value = error.response.data.msg;
        })
        .finally(() => {
            loading.value = false;
        });
};
</script>

<style>

.login-box {
    width: 25%;
    margin: 11% auto;
}
</style>
<template>
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div v-if="errorMessage" class="alert alert-danger" role="alert">
                    {{ errorMessage }}
                </div>
                <form @submit.prevent="handleSubmit">
                    <div class="input-group mb-3">
                        <input v-model="form.auth" class="form-control" placeholder="Email" type="email">
                    </div>
                    <div class="input-group mb-3">
                        <input v-model="form.password" class="form-control" placeholder="Password" type="password">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input id="remember" type="checkbox">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-primary btn-block" type="submit">
                                Sign In
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
