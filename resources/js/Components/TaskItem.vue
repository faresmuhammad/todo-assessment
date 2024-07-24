<template>
    <!--title-->
    <!--description-->
    <!--category tag-->
    <!--status tag-->
    <!--due date-->
    <!--actions - edit, delete-->
    <li class="row list-unstyled">
        <div class="col-12">
            <div class="card card-body mb-3">
                <div class="row">
                    <div class="col">
                        <div class="d-flex flex-column">
                            <h6>{{ task.title }}</h6>
                            <div class="text-muted">{{ task.description }}</div>
                            <tag :name="task.category" class="my-2 w-25" />
                        </div>
                    </div>
                    <div class="col-3 d-flex flex-column justify-content-between align-items-end">
                        <span>{{ task.due_date === null ? 'No Due Date' : 'Due to: ' + task.due_date }}</span>
                        <tag :name="task.status" class="my-2" />
                        <div class="btn-group">
                            <!--Open Edit Dialog-->
                            <button class="btn btn-warning mx-1">Edit</button>
                            <!--Call delete endpoint-->
                            <button class="btn btn-danger mx-1">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>

</template>
<script setup>
import Tag from "./Tag.vue";

const props = defineProps({
    task: Object
})
</script>


