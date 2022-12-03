<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import Input from '@/Components/App/Form/Input.vue';
import EditModal from '@/Components/App/Modal/Edit.vue';

const emit = defineEmits([
    'close', 
    'switchModal'
]);

const props = defineProps({
    show: Boolean,
    user: Object
});

let form = useForm(props.user);

const update = (id) => {
    form.transform(data => ({
        ...props.user
    })).put(route('users.update', {id}),{
        preserveScroll: true,
        onSuccess: () => {
            Notify.flash('Actualizado')
            emit('switchModal')
        },
    });
}
</script>
<template>
    <EditModal :show="show" @update="update(user.id)" @close="$emit('close')">

        <div class="w-full right-0 mt-2">
            <div class="rounded overflow-hidden">
                <div class="text-center p-6 bg-gray-800 border-b">
                    <p class="pt-2 text-lg font-bold text-gray-50">{{user.name}}</p>
                    <p class="text-sm text-gray-100">{{user.paternal}}  {{user.maternal}}</p>
                </div>
                <div class="py-2 border-b">
                    <div class="p-4">
                        <form>
                            <div class="grid gap-6 mb-6 lg:grid-cols-2">
                                <Input
                                    id="name"
                                    placeholder="Nombre"
                                    v-model="user.name"
                                    :onError="form.errors.name"
                                    required
                                />
                                <Input
                                    id="paternal"
                                    v-model="user.paternal"
                                    :onError="form.errors.paternal"
                                    required
                                />
                                <Input
                                    id="maternal"
                                    v-model="user.maternal"
                                    :onError="form.errors.maternal"
                                    required
                                />
                                <Input
                                    id="email"
                                    type="email"
                                    v-model="user.email"
                                    :onError="form.errors.email"
                                />
                                <Input
                                    id="phone"
                                    type="number"
                                    v-model="user.phone"
                                    :onError="form.errors.phone"
                                    maxlength="10"
                                />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </EditModal>
</template>