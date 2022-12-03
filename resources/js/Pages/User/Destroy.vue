<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import DestroyModal from '@/Components/App/Modal/Destroy.vue';

const emit = defineEmits([
    'close', 
    'switchModal'
]);

const props = defineProps({
    show: Boolean,
    user: Object
});

let form = useForm(props.user);

const destroy = (id) => {
    form.delete(route('users.destroy', {id}),{
        preserveScroll: true,
        onSuccess: () => {
            props.user.pop;
            emit('close');
            Notify.success(lang('users.deleted'));
        },
        onError: () => {
            Notify.info(lang('users.notFound'));
            emit('close');
        }
    });
}
</script>
<template>
    <DestroyModal :show="show" @destroy="destroy(user.id)" @close="$emit('close')">
        <div class="w-full right-0 mt-2">
            <div class="bg-white rounded overflow-hidden shadow-lg">
                <div class="text-center p-6 bg-gray-800 border-b">
                    <p class="pt-2 text-lg font-bold text-gray-50">{{user.name}}</p>
                    <p class="text-sm text-gray-100">{{user.paternal}}  {{user.maternal}}</p>
                </div>
            </div>
        </div>
    </DestroyModal>
</template>