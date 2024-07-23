<template>
    <form method="post" @submit.prevent="login(data)">

        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" v-model="data.email" required>
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" v-model="data.password" required>
        </div>

        <button type="submit">Login</button>
    </form>
</template>
<script setup>

import {reactive} from "vue";
import {useAuthentication} from "../../composables/authentication.js";

const {login} = useAuthentication()

const data = reactive({
    email: "",
    password: "",
})


</script>


<style scoped>

</style>
