<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { computed } from 'vue';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';

defineProps({
    href: String,
    as: String,
    icon: {
        type: String,
        default: 'notifications_active'
    }
});

let classes = computed(()=>{
    return 'inline-flex space-x-2 w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition';
});
</script>
<template>
    <div>
        <a v-if="as =='a'" :href="href" :class="classes">
            <GoogleIcon :name="icon" />
            <slot />
        </a>
        <Link v-else :href="href" :class="classes">
            <GoogleIcon :name="icon" class="text-primary hover:text-primary-hover" />
            <slot />
        </Link>
    </div>
</template>
