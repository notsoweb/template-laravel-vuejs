<script setup>
import DialogModal from '@/Components/App/DialogModal.vue';
import SecondaryButton from '@/Components/App/Button/Secondary.vue';
    
const emit = defineEmits([
    'update', 
    'close'
]);

const props = defineProps({
    title: {
        type: String,
        default: lang('edit')
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
                <SecondaryButton 
                    @click="$emit('update')"
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