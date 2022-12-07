<script setup>
import { computed } from 'vue';

const props = defineProps({
    color: {
        type: String,
        default: 'primary',
    },
    type: {
        type: String,
        default: 'submit',
    },
});
</script>
<template>
    <button 
        :type="type"
        class="inline-flex justify-center items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:opacity-90 focus:outline-none active:saturate-150 disabled:opacity-25 transition">
        <slot />
    </button>
</template>
