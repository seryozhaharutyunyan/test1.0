<template>
    <div class="col-5 m-auto">
        <input type="email" placeholder="email" v-model.trim="email" required class="form-control p-3 m-3">
        <input type="password" placeholder="password" v-model.trim="password" required class="form-control p-3 m-3">
        <button class="btn btn-secondary p-3 m-3" @click="login()">login</button>
    </div>
</template>

<script>
export default {
    name: "Login",

    data() {
        return {
            email: '',
            password: ''
        };
    },

    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                console.log(response);
                axios.post('/login', {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    localStorage.setItem('token', response.config.headers['X-XSRF-TOKEN']);
                    this.$router.push({name: "home"});
                })
            });
        }

    }
}
</script>

<style scoped>

</style>
