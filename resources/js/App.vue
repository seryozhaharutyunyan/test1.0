<template>
    <div class="m-3 p-3 text-center justify-content-center">
        <router-link :to="{ name: 'home'}" class="mt-2">
            Home |
        </router-link>
        <router-link v-if="!token" :to="{ name: 'login'}" class="mt-2">
            Login |
        </router-link>
        <router-link v-if="!token" :to="{ name: 'registration'}" class="mt-2">
            Registration |
        </router-link>
        <router-link v-if="!token" :to="{ name: 'product'}" class="mt-2">
            Add Product |
        </router-link>
        <router-link v-if="!token" :to="{ name: 'supply'}" class="mt-2">
            Add supply
        </router-link>
        <a href="#" v-if="token" @click.prevent="logout()" class="mt-2">
            Logout
        </a>
    </div>

    <RouterView></RouterView>
</template>

<script>
import axios from "axios";

export default {
    name: "App",

    data() {
        return {
            token: null,
        }
    },

    methods: {
        getToken() {
            this.token = localStorage.getItem('token');
        },

        logout() {
            axios.post('/logout')
                .then(() => {
                    localStorage.removeItem('token');
                    this.getToken();
                    this.$router.push({name: "login"});
                })
        }
    },

    watch: {
        '$route': {
            immediate: true,
            handler() {
                this.getToken();
            },
        },
    },

    mounted() {
        this.getToken();
    }
}
</script>

<style scoped>

</style>
