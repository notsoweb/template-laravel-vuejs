<script>
export default {
  inheritAttrs: false
}
</script>
<script setup>
import { computed, onMounted, ref } from 'vue';
import Label from '@/Components/App/Form/Elements/Label.vue';
import Error from '@/Components/App/Form/Elements/Error.vue';

const props = defineProps({
    title: String,
    id: String,
    onError: String,
    class: String,
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

const autoTitle = computed(() => {
    if(props.title) {
        return props.title;
    }

    return props.id;
});

const classes = computed(() => {
    return `w-full ${props.class}`
});

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>
<template>
    <div :class="classes">
        <Label :id="id" :title="autoTitle" :required="required" />
        <input class="input-primary"
            ref="input"
            :id="id"
            :type="type"
            :value="modelValue"
            :placeholder="placeholder"
            :required="required"
            @input="$emit('update:modelValue', $event.target.value)"
            v-bind="$attrs"
        >
        <Error :onError="onError" />
    </div>
</template>