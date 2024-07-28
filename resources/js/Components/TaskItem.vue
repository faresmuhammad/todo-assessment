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
                            <tag :name="task.category.name" class="my-2 w-25"/>
                        </div>
                    </div>
                    <div class="col-3 d-flex flex-column justify-content-between align-items-end">
                        <span>{{
                                task.due_date === null ? 'No Due Date' : 'Due to: ' + formatDate(task.due_date)
                            }}</span>
                        <tag :name="task.status" class="my-2"/>

                        <!--Action Buttons Section-->
                        <div v-if="trashed" class="btn-group">
                            <!--Call restore endpoint-->
                            <button class="btn btn-success mx-1" @click="restoreTask">Restore</button>
                            <!--Call permanent delete endpoint-->
                            <button class="btn btn-danger mx-1" @click="deleteTaskPermanently">Delete Forever</button>
                        </div>
                        <div v-else class="btn-group">
                            <!--Complete the task-->
                            <button v-if="task.status === 'pending'" class="btn btn-success mx-1" @click="completeTask">
                                Complete
                            </button>
                            <!--Open Edit Page-->
                            <button class="btn btn-warning mx-1" @click="navigateToEditPage">Edit</button>
                            <!--Call delete endpoint-->
                            <button class="btn btn-danger mx-1" @click="deleteTask">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>

</template>
<script setup>
import Tag from "./Tag.vue";
import router from "../router.js";
import axios from "axios";
import {BaseUrl} from "../constants.js";

const props = defineProps({
    task: Object,
    trashed: {
        type: Boolean,
        default: false
    }
})

const completeTask = async () => {
    try {
        await axios.patch(BaseUrl + '/tasks/' + props.task.id + '/complete')
        //Refresh the page
        router.go()
    } catch (e) {

    }

}

const navigateToEditPage = () => {
    router.push({name: 'edit-task', params: {id: props.task.id}})
}

const deleteTask = async () => {
    try {
        await axios.delete(BaseUrl + '/tasks/' + props.task.id)
        //Refresh the page
        router.go()
    } catch (e) {

    }
}

const deleteTaskPermanently = async () => {
    try {
        await axios.delete(BaseUrl + '/tasks/' + props.task.id + '/permanent')
        //Refresh the page
        router.go()
    } catch (e) {

    }
}

const restoreTask = async () => {
    try {
        await axios.patch(BaseUrl + '/tasks/' + props.task.id + '/restore')
        //Refresh the page
        router.go()
    } catch (e) {

    }
}

/**
 * Format a date to readable format
 */
const formatDate = (date) => {

    const parsedDate = new Date(date)
    const now = new Date()
    const tomorrow = new Date()
    tomorrow.setDate(now.getDate() + 1)

    let formattedText = ""
    if (parsedDate.toDateString() === now.toDateString())
        formattedText = "Today"
    else if (parsedDate.toDateString() === tomorrow.toDateString())
        formattedText = "Tomorrow"
    else
        formattedText = parsedDate.toLocaleString('en-US', {
            weekday: 'short',
            day: 'numeric',
            year: 'numeric',
            month: 'short'
        })
    return formattedText
}
</script>


