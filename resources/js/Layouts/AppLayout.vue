<script setup>
import {Head} from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import Header from '@/Components/App/Skeleton/Header.vue';
import Sidebar from '@/Components/App/Skeleton/Sidebar.vue';

defineProps({
    title: String,
    titlePage: {
        type: Boolean,
        default: true,
    }
});

// Comprueba los mensajes flash
if(Inertia.page.props.flash) {
    Inertia.page.props.flash.forEach(element => {
        Notify.flash(element.message, element.type);
    });
}

if (Inertia.page.props.jetstream.flash.length != 0) {
    Inertia.page.props.jetstream.flash.forEach(element => {
        Notify.flash(element.message, element.type);
    });
}
</script>
<template>
    <Head :title="title" />
    <Header />
    <Sidebar />
    <main id="page" class="flex justify-center pt-6 pl-14 md:pl-64">
        <div  class="w-full px-8 mt-4 pb-4 sm:px-6 lg:mb-8 lg:mx-8 lg:mt-14 lg:px-8 rounded-lg bg-white lg:p-8">
            <div v-if="titlePage" class="flex w-full justify-center pt-6 lg:pt-0">
                <h2 class="font-bold text-xl uppercase" v-text="title"></h2>
            </div>
            <slot />
        </div>
    </main>
</template>
