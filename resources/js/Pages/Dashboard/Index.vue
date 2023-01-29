<script setup>
import Welcome         from '@/Components/Dashboard/Welcome.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
</script>

<template>
    <DashboardLayout title="Dashboard">
        <div class="py-12">
            <Welcome />
        </div>
    </DashboardLayout>
</template>
