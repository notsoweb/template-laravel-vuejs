<script setup>
import DialogModal from '@/Components/App/DialogModal.vue';
import DangerButton from '@/Components/App/Button/Danger.vue';
import SecondaryButton from '@/Components/App/Button/Secondary.vue';
    
const emit = defineEmits([
    'close',
    'destroy',
]);

const props = defineProps({
    show: Boolean,
    title: {
        default: lang('delete.title'),
        type: String
    }
});
</script>

<template>
    <DialogModal :show="show">
        <template #title>
            <p
                class="font-bold text-xl"
                v-text="title"
            />
        </template>
        <template #content>
            <slot />
            <p 
                class="mt-4 text-justify text-danger"
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