<template>
    <div class="text-center m-4">
        <h1>Home</h1>
        <div class="col-12 col-sm-4 m-auto mt-3 text-center">
            <h2>Add edge</h2>
            <input type="date" class="form-control m-3 mb-0  p-3"
                   v-model.trim="date" placeholder="Date"
                   min="2021-01-13" max="2021-12-31">
            <button class="btn btn-secondary m-2" @click="apply()">Apply</button>

            <div class="m-auto info col-11 border"></div>

        </div>
    </div>

</template>

<script>

export default {
    name: "Index",

    data() {
        return {
            date: "",
        }
    },

    methods: {
        apply() {

        }
    }
}
</script>

<style scoped>
.info {
    border-radius: 10px;
    min-height: 200px;
}
</style>
