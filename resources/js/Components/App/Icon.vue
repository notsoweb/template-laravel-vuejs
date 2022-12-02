<script setup>
import { computed } from 'vue';

const props = defineProps({
    name:  String,
    outline: Boolean
})

const classes = computed(() => {
    return props.outline
        ? 'font-icon-outlined'
        : 'font-icon';
});
</script>

<template>
    <span :class="classes" v-text="name"></span>
</template>