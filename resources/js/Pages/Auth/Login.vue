<template>
    <div class="container min-vh-100">
        <div class="row min-vh-100 justify-content-center align-items-center">

            <div class="col-6">

                <form method="post" @submit.prevent="login(data)" class="d-flex flex-column gap-4 my-auto">

                    <div class="flex flex-column">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" v-model="data.email" required>
                    </div>
                    <div class="flex flex-column">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" v-model="data.password" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="remember" v-model="data.remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary" style="display: block">Login</button>
                </form>
                <div class="my-3 text-center">
                    <span>Not a member? </span>
                    <router-link :to="{name: 'register'}">Register</router-link>
                </div>
            </div>
        </div>
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


