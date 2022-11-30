<script setup>
defineProps({
    id: String,
    title: String,
    required: Boolean
});
</script>
<template>
    <label v-if="title" :for="id" class="block mb-2 text-sm font-medium text-gray-900">
        {{$t(title)}} <span class="text-red-500" v-if="required">*</span>
    </label>
</template>
