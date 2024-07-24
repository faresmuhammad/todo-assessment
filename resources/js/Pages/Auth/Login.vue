<template>
    <div class="container min-vh-100 justify-content-center">

        <form method="post" @submit.prevent="login(data)" class="d-flex flex-column gap-4 my-auto">

            <div class="flex flex-column">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" v-model="data.email" required>
            </div>
            <div class="flex flex-column">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" v-model="data.password" required>
            </div>
            <button type="submit" class="btn btn-primary" style="display: block">Login</button>
        </form>
    </div>

</template>
<script setup>

import {reactive} from "vue";
import {useAuthentication} from "../../composables/authentication.js";

const {login} = useAuthentication()

const data = reactive({
    email: "",
    password: "",
    remember: true
})


</script>


<style scoped>

</style>
