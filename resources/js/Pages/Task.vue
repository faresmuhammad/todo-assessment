<template>
    <div class="container min-vh-100">
        <div class="row min-vh-100 justify-content-center align-items-center ">
            <div class="card p-4 col-10">
                <h3 class="text-center">{{ route.params.id ? 'Update Task' : 'New Task'}}</h3>

                <form method="post" @submit.prevent="saveTask" class="d-flex flex-column gap-4 my-auto">

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

const route = useRoute()
const categories = ref([])
const task = ref({})
const data = reactive({
    title: "",
    description: null,
    status: "pending",
    //todo: implement conversion between js date and carbon date
    due_date: null,
    category_id: 0
})

onMounted(async () => {
    //Get categories list
    categories.value = (await axios.get(BaseUrl + '/categories')).data
    try {
        if (route.params.id) {

            //Get Task from the passed id parameter to fill form fields
            task.value = (await axios.get(BaseUrl + '/tasks/' + route.params.id)).data.data
            //Fill form data with task
            data.title = task.value.title
            data.description = task.value.description
            data.status = task.value.status
            data.category_id = task.value.category.id
            console.log(task.value)
        }

    } catch (e) {

    }

})
const saveTask = async () => {
    try {

        const resposnse = await axios.post(BaseUrl + '/tasks', {
            ...data,
            user_id: useAuthStore().user.id
        })
        console.log("Task created successfully")
        router.back()
    } catch (e) {
        console.error(e)
    }
}
</script>



