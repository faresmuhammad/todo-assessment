<template>
<h1>App Page</h1>
    <button @click="logout">Logout</button>
</template>
<script setup>
import {useAuthentication} from "../composables/authentication.js";

const {logout} = useAuthentication()
</script>

<style scoped>

</style>
