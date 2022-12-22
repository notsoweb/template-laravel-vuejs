<script setup>
import { useForm } from '@inertiajs/vue3';
import DestroyModal from '@/Components/App/Modal/Destroy.vue';

const emit = defineEmits([
    'close', 
    'switchModal'
]);

const props = defineProps({
    show: Boolean,
    notification: Object
});

let form = useForm(props.notification);

const destroy = (id) => {
    form.delete(route('notifications.destroy', {id}),{
        preserveScroll: true,
        onSuccess: () => {
            props.notification.pop;
            emit('close');
            Notify.success(lang('notifications.deleted'));
        },
        onError: () => {
            Notify.info(lang('notifications.notFound'));
            emit('close');
        }
    });
}
</script>
<template>
    <DestroyModal :show="show" @destroy="destroy(notification.id)" @close="$emit('close')">
        <div class="w-full right-0 mt-2">
            <div class="bg-white rounded overflow-hidden shadow-lg">
                <div class="text-center p-6 bg-gray-800 border-b">
                    <p class="pt-2 text-lg font-bold text-gray-50">{{notification.data.message}}</p>
                </div>
            </div>
        </div>
    </DestroyModal>
</template>