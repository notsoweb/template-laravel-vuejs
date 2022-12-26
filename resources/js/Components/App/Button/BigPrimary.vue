<script setup>
import GoogleIcon from '@/Components/App/GoogleIcon.vue';

defineProps({
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
        class="flex flex-col items-center justify-center w-full h-48 space-y-2 bg-primary text-primary-text hover:bg-primary-hover rounded-xl disabled:opacity-25 transition"
        :type="type" 
    >
        <GoogleIcon
            class="text-7xl"
            :name="icon"
        />
        <span>
            <slot />
        </span>
    </button>
</template>
