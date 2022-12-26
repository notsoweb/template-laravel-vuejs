<script setup>
import DialogModal from '@/Components/App/DialogModal.vue';
import SecondaryButton from '@/Components/App/Button/Secondary.vue';
    
const emit = defineEmits([
    'close',
    'edit'
]);

const props = defineProps({
    editable: Boolean,
    show: Boolean,
    title: {
        default: lang('details'),
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
        </template>
        <template #footer>
            <div class="space-x-2">
                <slot name="buttons" />
                <SecondaryButton 
                    v-if="editable"
                    @click="$emit('edit')"
                    v-text="$t('update')"
                />
                <SecondaryButton
                    @click="$emit('close')" 
                    v-text="$t('cancel')"
                />
            </div>
        </template>
    </DialogModal>
</template>