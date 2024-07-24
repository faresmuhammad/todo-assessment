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
     * Get results that query matches title or description
     * @param query
     * @returns {Promise<void>}
     */
    const search = async (query) => {
        await updateTasks(BaseUrl + '/tasks/search/' + query)
    }

    /**
     * Filter tasks list by status or category
     * The Given parameter is an object of {type (status,category_id), option ({value,text})}
     * @param f - filter object of {type,option}
     * @returns {Promise<void>}
     */
    const filter = async (f) => {
        await getTasks()
        if (f.type === 'status') {

            tasks.value = tasks.value.filter((task) => {
                console.log("filter task: ", task, f.option.text)
                return task.status === f.option.text
            })
        }else if (f.type === 'category_id'){
            tasks.value = tasks.value.filter((task) => {
                console.log("filter task: ", task, f.option.value)
                return task.category.id === f.option.value
            })
        }
        //todo: handle pagination on filter

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

    return {tasks, pageData, getTasks, getTrashedTasks, updateTasks, search, filter}

}

