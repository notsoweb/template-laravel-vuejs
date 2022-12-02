<script setup>
import { ref } from 'vue';
import TextInput from '@/Components/App/TextInput.vue';
import Icon from '@/Components/App/Icon.vue';

const emit = defineEmits(['search']);

let query = ref('');

const props = defineProps({
    placeholder: {
        type: String,
        default: 'Buscar...'
    }
})

const search = () => {
    emit('search', query.value);
}
</script>
<template>
   <div class="flex w-full justify-between items-center py-0.5 border-y-2 border-gray-800">
        <div>
            <label for="table-search" class="sr-only">Buscar</label>
            <div class="relative py-0.5">
                <div  @click="search" class="absolute inset-y-0 right-2 flex items-center pl-3 cursor-pointer text-gray-700 hover:scale-110 hover:text-red-500">
                    <Icon class="text-xl" name="search" />
                </div>
                <TextInput
                    id="search"
                    v-model="query"
                    type="text"
                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg outline-0 focus:ring-blue-500 focus:border-blue-500 block sm:w-56 md:w-72 lg:w-80 pr-10 px-2.5"
                    required
                    autocomplete="off"
                    :placeholder="placeholder"
                    @keyup.enter="search"
                />
            </div>
        </div>
        <div class="flex items-center space-x-2 text-sm" id="buttons">
            <slot />
        </div>
	</div>
</template>