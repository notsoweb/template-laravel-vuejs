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

const sidebar = (TwScreen.isDevice('phone')) 
    ? ref(true)
    : sessionFresh.getSidebar();

const openSidebar = () => {
    sidebar.value = !sidebar.value;
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
        <div 
            id="sidebar"
            class="fixed w-fit h-screen transition-all duration-300 z-10"
            :class="{'-translate-x-64 md:-translate-x-0':sidebar, '-translate-x-0 md:-translate-x-64':!sidebar}"
        >
            <Sidebar
                :sidebar="sidebar"
                @open="openSidebar"
            />
        </div>
        <div 
            class="flex flex-col w-full transition-all duration-300"
            :class="{'md:w-[calc(100vw-16rem)] md:ml-64':sidebar, 'md:w-screen md:ml-0':!sidebar}"
        >
            <div class="w-full h-14 bg-primary">
                <Header
                    :sidebar="sidebar"
                    @open="openSidebar"
                />
            </div>
            <main id="page" class="flex justify-center md:p-4 2xl:p-6">
                <div  class="w-full px-4 md:px-8 pb-4 sm:px-6 lg:px-8 md:rounded-lg bg-white lg:p-8">
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
