s<script setup>
import { onMounted, ref } from 'vue';
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

const sidebar = ref(true)

const openSidebar = () => {
    console.log('open sidebar');
}

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
    <div class="flex w-full min-h-screen ">
        <div class="w-fit">
            <Sidebar :sidebar="sidebar" @open="openSidebar" />
        </div>
        <div class="flex flex-col w-full">
            <Header />
            <main id="page" class="flex justify-center">
                <div  class="w-full px-8 pb-4 sm:px-6 lg:mb-8 lg:mx-8 lg:mt-8 lg:px-8 md:rounded-lg bg-white lg:p-8">
                    <div v-if="titlePage" class="flex w-full justify-center pt-6 lg:pt-0">
                        <h2
                            class="font-bold text-xl uppercase"
                            v-text="title"
                        />
                    </div>
                    <slot />
                </div>
            </main>
        </div>
    </div>
</template>
