import {ref} from "vue";
import {BaseUrl} from "../constants.js";

export const useTasks = () => {
    const tasks = ref([])

    const pageData = ref({})

    /**
     * Get Fresh Tasks
     * @returns {Promise<void>}
     */
    const getTasks = async () => {
        await updateTasks(BaseUrl + '/tasks')
    }

    /**
     * Get Deleted Tasks
     * @returns {Promise<void>}
     */
    const getTrashedTasks = async () => {
        await updateTasks(BaseUrl + '/tasks/trashed')
    }

    /**
     * Make api call with the given url which is for retrieving tasks pagination
     * then set tasks to tasks ref and pagination information to pageDate ref
     * @param url
     * @returns {Promise<void>}
     */
    const updateTasks = async (url) => {
        const response = await axios.get(url)
        tasks.value = response.data.data
        pageData.value = response.data.meta
    }

    return {tasks, pageData, getTasks, getTrashedTasks, updateTasks}

}

