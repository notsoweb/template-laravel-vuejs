<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';
</script>
<template>
    <Link :href="'/'" class="flex">
        <GoogleIcon name="dashboard" />
    </Link>
</template>
