<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';

defineProps({
    as: String,
    href: String,
    icon: {
        default: 'notifications_active',
        type: String
    }
});

let classes = computed(()=> {
    return 'inline-flex space-x-2 w-full px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition';
});
</script>
<template>
    <div>
        <button
            v-if="as == 'button'"
            :class="classes"
            type="button"
        >
            <GoogleIcon 
                :name="icon"
            />
            <slot />
        </button>

        <a
            v-else-if="as =='a'" 
            :class="classes"
            :href="href"
        >
            <GoogleIcon
                :name="icon"
            />
            <slot />
        </a>
        
        <Link
            v-else
            :class="classes"
            :href="href"
        >
            <GoogleIcon
                class="text-primary hover:text-primary-hover"
                :name="icon"
            />
            <slot />
        </Link>
    </div>
</template>
