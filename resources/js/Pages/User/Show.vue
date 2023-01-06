<script setup>
import GoogleIcon from '@/Components/Dashboard/GoogleIcon.vue';
import ShowModal from '@/Components/Dashboard/Modal/Show.vue';

const emit = defineEmits([
    'close', 
    'switchModal'
]);

let props = defineProps({
    show: Boolean,
    user: Object
});
</script>
<template>
    <ShowModal
        :show="show"
        editable
        @close="$emit('close')"
        @edit="$emit('switchModal')"
    >
        <div class="w-full right-0 mt-2">
            <div class="bg-white rounded overflow-hidden shadow-lg">
                <div class="text-center p-6 bg-gray-800 border-b">
                    <p class="pt-2 text-lg font-bold text-gray-50">
                        {{user.name}}
                    </p>
                    <p class="text-sm text-gray-100">
                        {{user.paternal}}  {{user.maternal}}
                    </p>
                </div>
                <div class="py-2 border-b">
                    <div>
                        <a class="px-4 py-2 hover:bg-gray-100 flex">
                            <GoogleIcon class="text-xl text-green-600" name="contact_mail" />
                            <div class="pl-3">
                                <p class="font-bold  text-lg text-gray-900 leading-none pb-2">
                                    {{$t('contact')}}
                                </p>
                                <p class="text-gray-800">
                                    <b>{{$t('phone')}}: </b>
                                    <a :href="`tel:${user.phone}`" target="_blank" class="hover:text-danger">
                                        {{user.phone}}
                                    </a>
                                </p>
                                <p class="text-gray-800">
                                    <b>{{$t('email')}}: </b>
                                    <a :href="`mailto:${user.email}`" target="_blank" class="hover:text-danger">
                                        {{user.email}}
                                    </a>
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </ShowModal>
</template>