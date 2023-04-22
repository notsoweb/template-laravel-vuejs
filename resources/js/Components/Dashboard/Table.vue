<script setup>
const emit = defineEmits([
  'send-pagination'
]);

const props = defineProps({
    items: Object,
});
</script>

<template>
    <section class="container mx-auto py-6">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
            <div class="w-full overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="table-head">
                            <slot name="head" />
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <template v-if="items.total > 0">
                            <slot
                                name="body"
                                :items="items.data"
                            />
                        </template>
                        <template v-else>
                            <tr>
                                <slot name="empty" />
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <template v-if="items.links">
        <div v-if="items.links.length > 3" class="flex w-full justify-end">
            <div class="flex w-full flex-wrap -mb-1">
              <template v-for="(link, k) in items.links" :key="k">
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