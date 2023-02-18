<template>
    <div class="text-center m-4">
        <h1>Home</h1>
        <div class="col-12 col-sm-4 m-auto mt-3 text-center">
            <h2>Add edge</h2>
            <input type="date" class="form-control m-3 mb-0  p-3"
                   v-model.trim="date" placeholder="Date"
                   min="2021-01-13" max="2021-12-31">
            <div class="text-center text-danger">{{ error }}</div>
            <button class="btn btn-secondary m-2" @click="apply()">Apply</button>
            <div v-if="products">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order number</th>
                        <th scope="col">Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(product, key) in products" :key="key">
                        <th scope="row">{{ key }}</th>
                        <td>{{ product.delivery_number }}</td>
                        <td>{{ product.product.name }}</td>
                        <td>{{ product.quantity }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.date }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="m-auto info col-11 border text-start p-4">
                <div v-if="show">
                    <div>Date: {{ data.date }}</div>
                    <div>Quantity: {{ data.quantity }}</div>
                    <div>Price: {{ data.price }}</div>
                </div>

            </div>

        </div>
    </div>

</template>

<script>

import data from "bootstrap/js/src/dom/data";

export default {
    name: "Index",

    data() {
        return {
            date: "",
            product_id: 3,
            error: '',
            data: {},
            show: false,
            products: false
        }
    },

    methods: {
        apply() {
            this.error = '';
            this.data = {}
            this.show = false;
            this.products = false;

            axios.post('/api/info', {
                date: this.date,
                product_id: this.product_id
            }).then(result => {
                this.show = true;
                this.data = result.data;
                console.log(result);
            }).catch(error => {
                this.data = {};
                this.show = false;
                if (error.response.data.message) {
                    this.error = error.response.data.message;
                    if (error.response.data.products) {
                        this.products = error.response.data.products;
                    }
                }
                console.log(error);
            })
        },
    },

    created() {
    }
}
</script>

<style scoped>
.info {
    border-radius: 10px;
    min-height: 200px;
}
</style>
