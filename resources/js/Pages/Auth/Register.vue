<template>
    <div class="container min-vh-100">
        <div class="row min-vh-100 justify-content-center align-items-center">

            <div class="col-6">
                <form method="post" @submit.prevent="register(data)" class="d-flex flex-column gap-4 my-auto">

                    <div class="flex flex-column">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" v-model="data.name" required>
                    </div>
                    <div class="flex flex-column">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" v-model="data.email" required>
                    </div>
                    <div class="flex flex-column">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" v-model="data.password" required>
                    </div>
                    <div class="flex flex-column">
                        <label for="password-confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" name="password-confirmation" class="form-control"
                               v-model="data.password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <div class="my-3 text-center">
                    <span>Already registered? </span>
                    <router-link :to="{name: 'login'}">Login</router-link>
                </div>
            </div>
        </div>
    </div>
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

