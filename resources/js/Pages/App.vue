<template>
    <router-link :to="{name: 'test'}">Test</router-link>
</template>
<script setup>

import {onMounted} from "vue";

onMounted(()=>{
    console.log("App mounted")
})
</script>

<style scoped>

</style>
