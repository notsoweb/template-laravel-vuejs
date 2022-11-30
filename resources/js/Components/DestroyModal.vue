<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
    
const emit = defineEmits([
    'destroy', 
    'close'
]);

const props = defineProps({
    title: {
        type: String,
        default: "Eliminar registro"
    },
    show: Boolean,
});
</script>
<template>
    <DialogModal :show="show">
        <template #title>
            <p class="font-bold text-xl" v-text="title"></p>
        </template>
        <template #content>
            <slot />
            <p class="mt-4 text-justify text-red-500">Al presionar ELIMINAR el registro se eliminará permanentemente y no podrá recuperarse.</p>
        </template>
        <template #footer>
            <div class="space-x-2">
                <slot name="buttons" />
                <SecondaryButton @click="$emit('destroy')" class="bg-red-500 text-white hover:text-white hover:opacity-80">
                    Eliminar
                </SecondaryButton>
                <SecondaryButton @click="$emit('close')">
                    Cancelar
                </SecondaryButton>
            </div>
        </template>
    </DialogModal>
</template>