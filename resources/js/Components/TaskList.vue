<template>
    <div class="flex flex-column gap-4 justify-content-center">
        <ul v-if="tasks.length !== 0">
            <task-item v-for="task in tasks" :task="task" :trashed="trashed"></task-item>
        </ul>
        <h3 class="text-center" v-else>No Tasks</h3>
        <paginator v-if="pageData.last_page !== 1" v-bind:page-data="pageData"
                   @updateTasks="(url) => updateTasks(url)"></paginator>

    </div>

</template>
<script setup>

import TaskItem from "./TaskItem.vue";
import Paginator from "./Paginator.vue";
import {onMounted} from "vue";
import {useTasks} from "../composables/tasks.js";
import {emitter} from "../emitter.js";

const props = defineProps({
    trashed: {
        type: Boolean,
        default: false
    }
})

const {tasks, pageData, getTasks, getTrashedTasks, updateTasks, search, filter} = useTasks()


onMounted(() => {
    if (props.trashed) getTrashedTasks()
    else getTasks()
})

//Listening on search event
emitter.on('searchClicked', (q) => search(q))

//Listening on filter applied event
emitter.on('filterApplied', (appliedFilter) => {
    console.log("filter: ", appliedFilter)
    filter(appliedFilter)
})
</script>

