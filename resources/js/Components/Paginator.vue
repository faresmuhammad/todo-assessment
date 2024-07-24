<template>
    <ul>
        <li v-for="link in pageData.links">
            <div v-if="link.url === null">{{ link.label }}</div>
            <div v-else>
                <button @click="$emit('updateTasks',link.url)">{{ link.label }}</button>
            </div>
        </li>
    </ul>
</template>
<script setup>
//props
//links
//total pages
//current page
import {onMounted} from "vue";
import {useTasks} from "../composables/tasks.js";

const {updateTasks} = useTasks()
const props = defineProps({
    pageData: Object
})


onMounted(() => {
})
</script>


<style scoped>

</style>
