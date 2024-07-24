<template>
    <div class="flex flex-column gap-4 justify-content-center">
        <template v-if="tasks.length !== 0">
            <ul>
                <task-item v-for="task in tasks" :task="task" :trashed="trashed"></task-item>
            </ul>
            <paginator v-bind:page-data="pageData" @updateTasks="(url) => updateTasks(url)"></paginator>
        </template>
        <h3 class="text-center" v-else>No Tasks</h3>

    </div>

</template>
<script setup>

import TaskItem from "./TaskItem.vue";
import Paginator from "./Paginator.vue";
import {onMounted, ref, watch} from "vue";
import {useTasks} from "../composables/tasks.js";

const props = defineProps({
    trashed: {
        type: Boolean,
        default: false
    }
})

const {tasks, pageData, getTasks, getTrashedTasks, updateTasks} = useTasks()


onMounted(() => {
    if (props.trashed) getTrashedTasks()
    else getTasks()
})

</script>

