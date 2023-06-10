<script setup>
defineProps({
    subtitle: String,
    title: String
})
</script>

<template>
    <div class="text-center p-6 bg-gray-800 border-b">
        <p class="pt-2 text-lg font-bold text-gray-50">
            {{ title }}
        </p>
        <p 
            v-if="subtitle"
            class="text-sm text-gray-100"
        >
            {{ subtitle }}
        </p>
    </div>
</template>