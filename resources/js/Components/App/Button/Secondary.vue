<script setup>
import Base from './Base.vue';

defineProps({
    type: {
        default: 'submit',
        type: String
    }
});
</script>

<template>
    <Base
        class="bg-secondary"
        :type="type"
    >
        <slot />
    </Base>
</template>
