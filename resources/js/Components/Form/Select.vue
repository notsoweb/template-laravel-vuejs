<script setup>
import {ref} from 'vue';
import Label from '@/Components/Form/Elements/Label.vue';
import Error from '@/Components/Form/Elements/Error.vue';

defineProps({
    title: String,
    options: Array,
    id: String,
    onError: String,
    modelValue: String | Number,
    required: Boolean
});

defineEmits(['update:modelValue']);

const input = ref(null);

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="w-full">
        <Label :id="id" :title="title" :required="required" />
        <select  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            :id="id"
            :value="modelValue"
            @change="$emit('update:modelValue', $event.target.value)"
            :required="required"
            v-bind="$attrs"
        >
            <option disabled value="">Elige una opción</option>
            <slot />
        </select>
        <Error :onError="onError" />
    </div>
</template>