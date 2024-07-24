<template>

    <div class="container">
        <task-list></task-list>
        <button @click="logout">Logout</button>
    </div>
</template>
<script setup>
import {useAuthentication} from "../composables/authentication.js";
import {onMounted, ref, watch} from "vue";
import TaskList from "../Components/TaskList.vue";
import {BaseUrl} from "../constants.js";
import {useTasks} from "../composables/tasks.js";

const {logout} = useAuthentication()
onMounted(() => {
})

</script>

<style scoped>

</style>
