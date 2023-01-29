<template>
    <div class="col-5 m-auto">
        <input type="name" placeholder="name" v-model.trim="name" required class="form-control p-3 m-3">
        <input type="email" placeholder="email" v-model.trim="email" required class="form-control p-3 m-3">
        <input type="password" placeholder="password" v-model.trim="password" required class="form-control p-3 m-3">
        <input type="password" placeholder="password confirmation" v-model.trim="password_confirmation" required
               class="form-control p-3 m-3">
        <button class="btn btn-secondary p-3 m-3" @click="registration()">login</button>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "Registration",

    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        }
    },

    methods: {
        registration() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register', {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation
                }).then(resolve => {
                    localStorage.setItem('token', resolve.config.headers['X-XSRF-TOKEN']);
                    this.$router.push({name: 'home'})
                }).catch(error => {
                    console.log(error);
                })
            });

        }
    }
}
</script>

<style scoped>

</style>
