<template>
    <div class="col-5 m-auto text-center">
        <h1>Add product</h1>

        <input type="text" placeholder="Product name" v-model.trim="name" class="form-control p-3 m-3">
        <div class="text-danger ms-3">{{ error }}</div>
        <button class="btn btn-secondary p-3 m-3" @click="add()">Add</button>
    </div>
</template>

<script>
export default {
    name: "AddProduct",

    data() {
        return {
            name: '',
            error: '',
        }
    },

    methods: {
        add() {
            this.error = '';

            axios.post('/api/product/add', {
                name: this.name
            }).then(() => {
                this.name = '';
            }).catch(error => {
                if (error.response.data.message) {
                    this.error = error.response.data.message;
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
