<template>
    <ul>
        <task-item v-for="task in tasks" :task="task"></task-item>
    </ul>
    <paginator v-bind:page-data="pageData" @updateTasks="(url) => updateTasks(url)"></paginator>
</template>
<script setup>

import TaskItem from "./TaskItem.vue";
import Paginator from "./Paginator.vue";
import {onMounted} from "vue";
import {useTasks} from "../composables/tasks.js";

const {tasks,pageData,getTasks,updateTasks} = useTasks()


onMounted(() => {
    getTasks()
})
</script>


<style scoped>

</style>
