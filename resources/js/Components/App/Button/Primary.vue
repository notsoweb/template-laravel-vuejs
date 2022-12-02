<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>
<template>
    <button :type="type" class="inline-flex justify-center items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-primary-text uppercase tracking-widest hover:bg-primary-hover focus:outline-none focus:border-primary disabled:opacity-25 transition">
        <slot />
    </button>
</template>
