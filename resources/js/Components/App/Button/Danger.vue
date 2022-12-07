<script setup>
import Base from './Base.vue';

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>
<template>
    <Base
        class="bg-danger"
        color="danger"
        :type="type"
    >
        <slot />
    </Base>
</template>
