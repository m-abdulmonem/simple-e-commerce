import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthUserStore = defineStore('AuthUserStore', () => {
    const userAuth = JSON.parse(localStorage.getItem("user"));
    const user = ref({
        name: userAuth?.name ??'',
        email: userAuth?.email ??'',
        is_admin: userAuth?.is_admin??'',
        phone: userAuth?.phone??'',
        token : localStorage.getItem("token")??''
    });

    /**
     * @deprecated
     */
    const getAuthUser =  () => {
        console.log(localStorage.getItem("user"))
        const userAuth = localStorage.getItem("user");

        user.name = userAuth.name;
        user.email = userAuth.email;
        user.is_admin = userAuth.is_admin;
        user.phone = userAuth.phone;
        user.token = localStorage.getItem("token")
    };

    const setAuthUser =  (user) => {
        localStorage.setItem("token", user.token)
        localStorage.setItem("user", JSON.stringify(user))
    };

    return { user, getAuthUser, setAuthUser };
});
