import {ref} from "vue";
import {BaseUrl} from "../constants.js";

export const useTasks = () => {
    const tasks = ref([])

    const pageData = ref({})
    const getTasks = async () => {
        await updateTasks(BaseUrl + '/tasks')
    }

    const updateTasks = async (url) => {
        const response = await axios.get(url)
        tasks.value = response.data.data
        pageData.value = response.data.meta
        console.log(tasks.value)
        console.log(pageData.value)
    }

    return {tasks, pageData, getTasks, updateTasks}

}

