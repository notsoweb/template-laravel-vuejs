<script setup>
import DialogModal from '@/Components/App/DialogModal.vue';
import SecondaryButton from '@/Components/App/Button/Secondary.vue';
import DangerButton from '@/Components/App/Button/Danger.vue';
    
const emit = defineEmits([
    'destroy', 
    'close'
]);

const props = defineProps({
    title: {
        type: String,
        default: lang('delete.title')
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
            <p 
                class="mt-4 text-justify text-red-500"
                v-text="$t('delete.confirm')"
            />
        </template>
        <template #footer>
            <div class="space-x-2">
                <slot name="buttons" />
                <DangerButton
                    @click="$emit('destroy')"
                    v-text="$t('delete.title')"
                />
                <SecondaryButton
                    @click="$emit('close')"
                    v-text="$t('cancel')"
                />
            </div>
        </template>
    </DialogModal>
</template>