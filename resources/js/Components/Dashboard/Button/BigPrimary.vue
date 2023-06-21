<script setup>
import GoogleIcon from '@/Components/Shared/GoogleIcon.vue';

defineProps({
    title: String,
    href: String,
    icon: {
        default: 'people',
        type: String
    },
    type: {
        default: 'submit',
        type: String
    }
});
</script>

<template>
    <button 
        class="flex flex-col items-center justify-center w-full h-48 space-y-2 bg-primary text-white hover:bg-secondary rounded-xl disabled:opacity-25 transition"
        :type="type" 
    >
        <GoogleIcon
            :title="title"
            class="text-7xl"
            :name="icon"
        />
        <span>
            <slot />
        </span>
    </button>
</template>
