<template>
    <div class="col-5 m-auto">
        <input type="name" placeholder="name" v-model.trim="name" required class="form-control p-3 m-3">
        <div class="text-danger ms-3">{{errors.name[0]}}</div>
        <input type="email" placeholder="email" v-model.trim="email" required class="form-control p-3 m-3">
        <div class="text-danger ms-3">{{errors.email[0]}}</div>
        <input type="password" placeholder="password" v-model.trim="password" required class="form-control p-3 m-3">
        <div class="text-danger ms-3">{{errors.password[0]}}</div>
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
            password_confirmation: '',
            errors: {
                email: [""],
                name: [""],
                password: [""],
            }
        }
    },

    methods: {
        registration() {
            this.errors = {
                email: [""],
                name: [""],
                password: [""],
            };

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
                    if (error.response.data.message) {
                        this.errors = {...this.errors, ...error.response.data.errors};
                    }
                })
            });

        }
    }
}
</script>

<style scoped>

</style>
