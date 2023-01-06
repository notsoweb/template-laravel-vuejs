s<script setup>
import { onMounted } from 'vue';
import { SuscribeUserAuth } from '@/broadcasts.js';
import { Head, router } from '@inertiajs/vue3';
import Header from '@/Components/Dashboard/Skeleton/Header.vue';
import Sidebar from '@/Components/Dashboard/Skeleton/Sidebar.vue';

defineProps({
    title: String,
    titlePage: {
        default: true,
        type: Boolean
    }
});

// Comprueba los mensajes flash
if(router.page.props.flash) {
    router.page.props.flash.forEach(element => {
        Notify.flash(element.message, element.type);
    });
}

if (router.page.props.jetstream.flash.length != 0) {
    router.page.props.jetstream.flash.forEach(element => {
        Notify.flash(element.message, element.type);
    });
}

onMounted(()=> {
    if (!sessionFresh.isLayoutInitialized()) {
        SuscribeUserAuth();
        sessionFresh.startLayout();
    }
});
</script>
<template>
    <Head
        :title="title"
    />
    <Header />
    <Sidebar />
    <main id="page" class="flex justify-center pt-6 pl-14 md:pl-64">
        <div  class="w-full px-8 mt-4 pb-4 sm:px-6 lg:mb-8 lg:mx-8 lg:mt-14 lg:px-8 rounded-lg bg-white lg:p-8">
            <div v-if="titlePage" class="flex w-full justify-center pt-6 lg:pt-0">
                <h2
                    class="font-bold text-xl uppercase"
                    v-text="title"
                />
            </div>
            <slot />
        </div>
    </main>
</template>
