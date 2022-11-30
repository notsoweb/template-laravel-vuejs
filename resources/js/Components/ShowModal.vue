<script setup>
import DialogModal from '@/Components/DialogModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
    
const emit = defineEmits([
    'edit', 
    'close'
]);

const props = defineProps({
    title: {
        type: String,
        default: "Detalles"
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
        </template>
        <template #footer>
            <div class="space-x-2">
                <slot name="buttons" />
                <SecondaryButton @click="$emit('edit')">
                    Actualizar
                </SecondaryButton>
                <SecondaryButton @click="$emit('close')">
                    Cerrar
                </SecondaryButton>
            </div>
        </template>
    </DialogModal>
</template>