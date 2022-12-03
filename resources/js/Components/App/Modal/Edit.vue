<script setup>
import DialogModal from '@/Components/App/DialogModal.vue';
import SecondaryButton from '@/Components/App/SecondaryButton.vue';
    
const emit = defineEmits([
    'update', 
    'close'
]);

const props = defineProps({
    title: {
        type: String,
        default: "Editar"
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
                <SecondaryButton @click="$emit('update')">
                    Actualizar
                </SecondaryButton>
                <SecondaryButton @click="$emit('close')">
                    Cerrar
                </SecondaryButton>
            </div>
        </template>
    </DialogModal>
</template>