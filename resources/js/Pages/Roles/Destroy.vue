<script setup>
import { useForm } from '@inertiajs/vue3';
import DestroyModal from '@/Components/Dashboard/Modal/Destroy.vue';

const emit = defineEmits([
    'close', 
    'switchModal'
]);

const props = defineProps({
    role: Object,
    show: Boolean
});

let form = useForm(props.role);

const destroy = (id) => {
    form.delete(route('roles.destroy', {id}),{
        preserveScroll: true,
        onSuccess: () => {
            props.role.pop;
            emit('close');
            Notify.success(lang('roles.deleted'));
        },
        onError: () => {
            Notify.info(lang('roles.notFound'));
            emit('close');
        }
    });
}
</script>
<template>
    <DestroyModal :show="show" @destroy="destroy(role.id)" @close="$emit('close')">
        <div class="w-full right-0 mt-2">
            <div class="bg-white rounded overflow-hidden shadow-lg">
                <div class="text-center p-6 bg-gray-800 border-b">
                    <p class="pt-2 text-lg font-bold text-gray-50">
                        {{role.name}}
                    </p>
                </div>
            </div>
        </div>
    </DestroyModal>
</template>