<template>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <router-link class="navbar-brand" :to="{name:'app'}">To-Do INVADE</router-link>
            <ul class="nav me-auto mb-2 ">
                <li class="nav-item"> <router-link class="nav-link" :to="{name: 'app'}">Tasks</router-link></li>
                <li class="nav-item"> <router-link class="nav-link" :to="{name: 'trashed'}">Trash</router-link></li>
            </ul>
            <button class="btn btn-primary" @click="logout">Logout</button>
        </div>
    </nav>
</template>
<script setup>

import {useAuthentication} from "../composables/authentication.js";

const {logout} = useAuthentication()
</script>



