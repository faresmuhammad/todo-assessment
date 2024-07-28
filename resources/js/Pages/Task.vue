<template>
    <div class="container min-vh-100">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="card p-4 col-10">
                <h3 class="text-center">{{ route.params.id ? 'Update Task' : 'New Task' }}</h3>

                <form method="post" @submit.prevent="submitForm" class="d-flex flex-column gap-4 my-auto">

                    <!--Title Field-->
                    <div class="input-group">
                        <label for="title" class="input-group-text">Title</label>
                        <input type="text" class="form-control" name="title" v-model="data.title" required>
                    </div>

                    <!--Description Field-->
                    <div class="input-group">
                        <label for="description" class="input-group-text">Description</label>
                        <textarea class="form-control" name="description" v-model="data.description"></textarea>
                    </div>

                    <!--Status and Category Fields-->
                    <div class="row">
                        <div class="input-group col">
                            <label for="status" class="input-group-text">Status</label>
                            <select class="form-select" v-model="data.status">
                                <option value="pending" selected>Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>
                        <div class="input-group col">
                            <label for="category" class="input-group-text">Category</label>
                            <select class="form-select" v-model="data.category_id">
                                <option v-for="category in categories" :value="category.value">{{
                                        category.text
                                    }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <!--Due Date Field-->
                    <div class="input-group">
                        <label for="duedate" class="input-group-text">Due Date</label>
                        <input type="date" class="form-control" name="duedate" v-model="data.due_date">
                    </div>

                    <!--Submit Button-->
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </div>
    </div>
</template>
<script setup>
import {onMounted, reactive, ref, watch} from "vue";
import axios from "axios";
import {BaseUrl} from "../constants.js";
import {useAuthStore} from "../stores/auth.js";
import router from "../router.js";
import {useRoute} from "vue-router";
import {useTasks} from "../composables/tasks.js";

const route = useRoute()
const {saveTask,updateTask} = useTasks()

const categories = ref([])
const task = ref({})
const data = reactive({
    title: "",
    description: null,
    status: "pending",
    due_date: null,
    category_id: 1
})

const isNewTask = ref(true)

onMounted(async () => {
    //Get categories list
    categories.value = (await axios.get(BaseUrl + '/categories')).data
    try {
        //check if there is incoming task id to update
        if (route.params.id) {
            //Set isNewTask to false
            isNewTask.value = false
            //Get Task from the passed id parameter to fill form fields
            task.value = (await axios.get(BaseUrl + '/tasks/' + route.params.id)).data.data
            //Fill form data with task
            fillTaskData()
        }

    } catch (e) {

    }

})


const submitForm = () => {
    if (isNewTask.value)
        saveTask(data)
    else
        updateTask(task.value.id,data)

    router.back()
}

const fillTaskData = () => {
    data.title = task.value.title
    data.description = task.value.description
    data.status = task.value.status
    data.category_id = task.value.category.id


    data.due_date = convertToDateInputFormat(task.value.due_date)
}

/**
 * due_date value stored in the task is in this format 2024-07-29 00:00:00
 * date input tag needs the date part only
 */
const convertToDateInputFormat = (datetime) => {
    return datetime.slice(0, 10)
}
</script>



