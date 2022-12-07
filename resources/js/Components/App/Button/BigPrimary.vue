<script setup>
import GoogleIcon from '@/Components/App/GoogleIcon.vue';

defineProps({
    icon: {
        type: String,
        default: 'people'
    },
    type: {
        type: String,
        default: 'submit',
    },
    href: String
});
</script>
<template>
    <button :type="type" class="flex flex-col items-center justify-center w-full h-48 space-y-2 bg-primary text-primary-text hover:bg-primary-hover rounded-xl disabled:opacity-25 transition">
        <GoogleIcon :name="icon" class="text-7xl" />
        <span>
            <slot />
        </span>
    </button>
</template>
