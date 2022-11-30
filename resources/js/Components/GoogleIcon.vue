<script setup>
import { computed } from 'vue';

const props = defineProps({
    name:  String,
    outline: Boolean
})

const classes = computed(() => {
    return props.outline
        ? 'font-google-icon-outlined'
        : 'font-google-icon';
});
</script>
<template>
    <span :class="classes" v-text="name" translate="no"></span>
</template>