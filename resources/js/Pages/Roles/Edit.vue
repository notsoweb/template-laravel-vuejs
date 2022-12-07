<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import Input from '@/Components/App/Form/Input.vue';
import EditModal from '@/Components/App/Modal/Edit.vue';

const emit = defineEmits([
    'close', 
]);

const props = defineProps({
    role: Object,
    show: Boolean,
});

const form = useForm(props.role);

const update = (id) => {
    form.transform(data => ({
        ...props.role
    })).put(route('roles.update', {id}),{
        preserveScroll: true,
        onSuccess: () => {
            Notify.success(lang('updated'));
            emit('close');
        },
    });
}
</script>
<template>
    <EditModal :show="show" @update="update(role.id)" @close="$emit('close')">
        <div class="w-full right-0 mt-2">
            <div class="rounded overflow-hidden">
                <div class="text-center p-6 bg-gray-800 border-b">
                    <p class="pt-2 text-lg font-bold text-gray-50">{{role.name}}</p>
                </div>
                {{form}}
                <div class="py-2 border-b">
                    <div class="p-4">
                        <form>
                            <div class="grid gap-6 mb-6 lg:grid-cols-2">
                                <Input
                                    id="name"
                                    v-model="role.name"
                                    :onError="form.errors.name"
                                    required
                                />
                                <Input
                                    id="description"
                                    v-model="role.description"
                                    :onError="form.errors.description"
                                    required
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </EditModal>
</template>