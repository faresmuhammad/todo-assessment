<template>
    <form method="post" @submit.prevent="register(data)">

        <div class="field">
            <label for="name">Name</label>
            <input type="text" name="name" v-model="data.name" required>
        </div>
        <div class="field">
            <label for="email">Email</label>
            <input type="email" name="email" v-model="data.email" required>
        </div>
        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" v-model="data.password" required>
        </div>
        <div class="field">
            <label for="password-confirmation">Password Confirmation</label>
            <input type="password" name="password-confirmation" v-model="data.password_confirmation" required>
        </div>

        <button type="submit">Register</button>
    </form>
</template>
<script setup>

import {reactive} from "vue";
import {useAuthentication} from "../../composables/authentication.js";

const {register} = useAuthentication()

const data = reactive({
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
})


</script>


<style scoped>

</style>
