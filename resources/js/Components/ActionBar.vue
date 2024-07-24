<template>
    <!--add button-->
    <!--filter by status, category-->
    <!--sort by due date-->
    <!--search by title, description-->
    <div class="row p-3">

        <!--Search form section-->
        <div class="col-4">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search ..." v-model="searchQuery"/>
                <button class="btn btn-outline-dark" @click="$emit('search',searchQuery)">Search</button>
            </div>
        </div>

        <!--Filter Section-->
        <div class="col-2">
            <div class="d-flex flex-column">

                <div class="input-group">
                    <label for="filter-select" class="input-group-text">Filter</label>
                    <select class="form-select" v-model="filterType" id="filter-select" @change="getFilterOptions">
                        <option selected>None</option>
                        <option value="Status">Status</option>
                        <option value="Category">Category</option>
                    </select>
                </div>
                <div v-if="filterType !== 'None'" class="input-group">
                    <label for="filter-options" class="input-group-text">Options</label>
                    <select class="form-select" v-model="appliedFilter" id="filter-options" @change="applyFilter">
                        <option v-for="option in filterOptions" :value="option.value">{{ option.text }}</option>
                    </select>
                </div>
            </div>
        </div>

        <!--Sorting Section-->
        <div class="col-2">
            <div class="d-flex flex-column">

                <div class="input-group"><label for="sort-select" class="input-group-text">Sort</label>
                    <select class="form-select" v-model="sortType" id="sort-select" >
                        <option selected>None</option>
                        <option value="duedate">Due Date</option>
                    </select>
                </div>
            </div>
        </div>
        <!--New Task Button-->
        <div class="col-2 d-inline-flex justify-content-end">
            <router-link :to="{name:'new-task'}" class="btn btn-primary">New Task</router-link>
        </div>
    </div>
</template>
<script setup>

import {ref} from "vue";
import {BaseUrl} from "../constants.js";

const searchQuery = ref("")

const filterType = ref("None")
const filterOptions = ref([])
const appliedFilter = ref()


const sortType = ref("None")
const getFilterOptions = async () => {
    if (filterType.value === "Status") {
        filterOptions.value = [
            {value: 0, text: "pending"},
            {value: 0, text: "completed"},
        ]
    } else if (filterType.value === "Category") {
        //Get categories from database with format of {value (id), text (name)}
        filterOptions.value = (await axios.get(BaseUrl + '/categories')).data
    } else
        filterOptions.value = []
}

const applyFilter = () => {

}
</script>



