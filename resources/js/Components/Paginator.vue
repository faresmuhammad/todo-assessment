<template>
    <ul class="pagination justify-content-center">
        <li v-for="link in pageData.links" class="page-item" :class="{disabled: link.url === null}">
            <div v-if="link.url === null" class="page-link">{{ link.label }}</div>
            <div v-else>
                <button @click="$emit('updateTasks',link.url)" class="page-link">{{ link.label }}</button>
            </div>
        </li>
    </ul>
</template>
<script setup>
//props
//links
//total pages
//current page - fix needed


const props = defineProps({
    pageData: Object
})




</script>


