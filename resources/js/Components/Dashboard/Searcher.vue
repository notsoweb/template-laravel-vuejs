<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import GoogleIcon from '@/Components/Shared/GoogleIcon.vue';

const emit = defineEmits([
    'search'
]);

let query = ref('');

const props = defineProps({
    placeholder: {
        default: lang('search'),
        type: String
    }
})

const search = () => {
    emit('search', query.value);
}
</script>
<template>
   <div class="flex w-full justify-between items-center border-y-2 border-gray-800">
        <div>
            <div class="relative py-1 z-0">
                <div  @click="search" class="absolute inset-y-0 right-2 flex items-center pl-3 cursor-pointer text-gray-700 hover:scale-110 hover:text-danger">
                    <GoogleIcon
                        class="text-xl"
                        name="search"
                    />
                </div>
                <input
                    id="search"
                    class="bg-gray-200 border border-gray-300 text-gray-900 text-sm rounded-lg outline-0 focus:ring-primary focus:border-primary block sm:w-56 md:w-72 lg:w-80 pr-10 px-2.5 py-1"
                    autocomplete="off"
                    :placeholder="placeholder"
                    required
                    type="text"
                    v-model="query"
                    @keyup.enter="search"
                />
            </div>
        </div>
        <div class="flex items-center space-x-2 text-sm" id="buttons">
            <slot />
            <Link :href="route('dashboard.index')">
                <GoogleIcon
                    class="btn-icon-primary"
                    name="home"
                    outline
                />
            </Link>
        </div>
	</div>
</template>