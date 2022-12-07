<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import VueMultiselect from 'vue-multiselect'
import JetButton from '@/Components/App/Button/Primary.vue';
import JetFormSection from '@/Components/App/FormSection.vue';

const props = defineProps({
    user: Object,
    userRoles: Object,
    roles: Object,
});

let value =  ref(props.userRoles);

let form = useForm({
    _method: 'POST',
    roles: value,
    user_id: props.user.id,
});

const updateProfileInformation = () => {
    if (value.value.length < 1) {
        return Notify.error(lang('users.roles.error.min'));
    }

    form.post(route('users.syncRoles'), {
        preserveScroll: true,
        onSuccess: () => {
            Notify.success(lang('updated'));
        },
        onError: () => {
            Notify.error(lang('updatedFail'));
        }
    });
};
</script>

<template>
    <JetFormSection @submitted="updateProfileInformation">
        <template #title>
            {{$t('users.roles.title')}}
        </template>
        <template #description>
            <p>
                {{$t('users.roles.description')}}
            </p>
        </template>
        <template #form>
            <div class="col-span-6 sm:col-span-4 space-y-4">
                <div>
                    <label class="typo__label">Roles</label>
                    <VueMultiselect 
                        v-model="value"
                        :options="roles"
                        :multiple="true"
                        :close-on-select="false"
                        :clear-on-select="false"
                        :preserve-search="true"
                        placeholder="Buscar ..."
                        label="name"
                        track-by="id"
                    >
                        <template slot="selection" v-slot="{ values, search, isOpen }">
                            <span 
                                class="multiselect__single" 
                                v-if="values.length &amp;&amp; !isOpen"
                            >
                                {{ values.length }} options selected
                            </span>
                        </template>
                    </VueMultiselect>
                </div>
            </div>
        </template>
        <template #actions>
            <JetButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{$t('update')}}
            </JetButton>
        </template>
    </JetFormSection>
</template>
