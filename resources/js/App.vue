<template>
    <router-link :to="{ name: 'home'}">Home</router-link>
    <RouterView></RouterView>
</template>

<script>
export default {
    name: "App"
}
</script>

<style scoped>

</style>
