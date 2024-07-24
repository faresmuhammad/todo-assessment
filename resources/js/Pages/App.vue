<template>
    <nav-bar></nav-bar>
    <div class="container my-4">
        <div class="d-flex flex-column">
            <action-bar></action-bar>
            <task-list></task-list>
        </div>

    </div>
</template>
<script setup>
import TaskList from "../Components/TaskList.vue";
import NavBar from "../Components/NavBar.vue";
import ActionBar from "../Components/ActionBar.vue";


</script>

<style scoped>

</style>
