<script setup>
const emit = defineEmits([
  'send-pagination'
]);

const props = defineProps({
    'links': Array
});
</script>

<template>
    <section class="container mx-auto py-6">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <slot name="head" />
                    </thead>
                    <tbody class="bg-white">
                        <slot name="body" />
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <template v-if="links">
        <div v-if="links.length > 3" class="flex w-full justify-end">
            <div class="flex w-full flex-wrap -mb-1">
              <template v-for="(link, k) in links" :key="k">
                <div v-if="link.url === null"
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label"
                ></div>
    
                <button v-else class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded" 
                    :class="{ 'bg-primary text-white': link.active }"
                    v-html="link.label"
                    @click="$emit('send-pagination', link.label)"
                ></button>
              </template>
            </div>
        </div>
    </template>
</template>