<script setup>
import Icon from '@/Components/App/Icon.vue';
import Label from '@/Components/App/Form/Elements/Label.vue';
import Error from '@/Components/App/Form/Elements/Error.vue';
import { computed, ref } from 'vue';

defineEmits([
    'search'
]);

defineProps({
    title: String,
    id: String,
    class: String,
    onError: String,
    placeholder: {
        type: String,
        default: 'Nombre, Correo, Telefono',
    },
    required: Boolean,
});

let input = ref('');

const classes = computed(() => {
    return `w-full ${props.class}`
});

defineExpose({
    focus: () => input.value.focus()
});

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});
</script>
<template>
    <div :class="classes">
        <Label :id="id" :title="title" :required="required" />
        <div class="relative mt-1">
            <div @click="$emit('search', input)" class="absolute inset-y-0 right-2 flex items-center pl-3 cursor-pointer text-gray-700 hover:scale-110 hover:text-red-500">
                <Icon class="text-xl" name="search" />
            </div>
            <input
                id="search"
                name="search"
                v-model="input"
                type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pr-10 p-2.5"
                required
                autocomplete="off"
                :placeholder="placeholder"
                @keyup.enter="$emit('search', input)"
            >
            <Error :onError="onError" />
        </div>
    </div>
</template>