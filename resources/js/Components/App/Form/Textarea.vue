<script setup>
import { onMounted, ref } from 'vue';
import Label from '@/Components/App/Form/Elements/Label.vue';
import Error from '@/Components/App/Form/Elements/Error.vue';

defineProps({
    title: String,
    id: String,
    onError: String,
    modelValue: String | Number,
    type: {
        type: String,
        default: 'text',
    },
    placeholder: String,
    required: Boolean
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="w-full">
        <Label :id="id" :title="title" :required="required" />
        <textarea v-bind="$attrs" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            ref="input"
            :id="id"
            :type="type"
            :value="modelValue"
            :placeholder="placeholder"
            :required="required"
            rows="5"
            @input="$emit('update:modelValue', $event.target.value)"
        ></textarea>
        <Error :onError="onError" />
    </div>
</template>