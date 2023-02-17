<template>
    <div class="col-12 col-sm-6 m-auto mt-3 text-center">
        <h2>Add edge</h2>
        <input class="form-control m-3 mb-0  p-3" v-model.trim="delivery_number" placeholder="Delivery number">
        <div class="text-start text-danger m-3">{{ error.delivery_number[0] }}</div>
        <select class="form-control m-3 mb-0 p-3" v-model="product_id">
            <option value="" disabled>Products</option>
            <option v-for="(product, key) in products" :value="product.id" :key="key">
                {{ product.name }}
            </option>
        </select>
        <div class="text-start text-danger m-3">{{ error.product_id[0] }}</div>
        <input type="number" class="form-control m-3 mb-0  p-3" v-model.trim="quantity" placeholder="Quantity">
        <div class="text-start text-danger m-3">{{ error.quantity[0] }}</div>
        <input type="number" class="form-control m-3 mb-0  p-3" v-model.trim="price" placeholder="Price">
        <div class="text-start text-danger m-3">{{ error.price[0] }}</div>
        <input type="date" class="form-control m-3 mb-0  p-3" v-model.trim="date" min="2021-01-01" max="2021-12-31">
        <div class="text-start text-danger m-3">{{ error.date[0] }}</div>
        <button class="btn btn-secondary m-2" @click="add()">Add</button>

    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "AddSupply",

    data() {
        return {
            delivery_number: '',
            product_id: '',
            quantity: '',
            price: '',
            date: '',

            error: {
                delivery_number: [''],
                product_id: [''],
                quantity: [''],
                price: [''],
                date: ['']
            },

            products: {}
        }
    },

    methods: {
        query() {
            axios.get('/api/product/all')
                .then(result => {
                    this.products = result.data
                })
        },

        add() {
            this.error = {
                delivery_number: [''],
                product_id: [''],
                quantity: [''],
                price: [''],
                date: ['']
            };

            axios.post('/api/supply/add', {
                delivery_number: this.delivery_number,
                product_id: this.product_id,
                quantity: this.quantity,
                price: this.price,
                date:this.date
            }).then((r) => {
                console.log(r);
                this.delivery_number = '';
                this.product_id = '';
                this.quantity = '';
                this.price = '';
                this.date = '';
            }).catch(error=>{
                if (error.response.data.message) {
                    this.error = {...this.error, ...error.response.data.errors};
                }
            })
        }
    },

    created() {
        this.query();
    }
}
</script>

<style scoped>

</style>
