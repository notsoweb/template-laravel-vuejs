<script setup>
import { Link } from '@inertiajs/vue3';
import GoogleIcon from '@/Components/Dashboard/GoogleIcon.vue';

const appName = window.appName;
</script>
<template>
    <Link :href="'/'" class="flex space-x-2">
        <GoogleIcon
            name="dashboard"
        />
        <span class="uppercase hidden md:block">
            {{appName}}
        </span>
    </Link>
</template>
