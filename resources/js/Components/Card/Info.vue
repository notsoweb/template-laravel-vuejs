<script setup>
import Icon from '@/Components/Icon.vue';

const props = defineProps({
    icon: String,
    info: String,
    description: String
});
</script>
<template>
    <div class="bg-blue-500 dark:bg-gray-800 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 dark:border-gray-600 text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
          <Icon class="text-3xl text-blue-800 dark:text-gray-800 transform transition-transform duration-500 ease-in-out" :name="icon" />
        </div>
        <div class="text-right">
          <p class="text-2xl" v-text="info"></p>
          <p v-text="description"></p>
        </div>
    </div>
</template>