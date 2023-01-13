<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import FormSection from '@/Components/Dashboard/FormSection.vue';
import PrimaryButton from '@/Components/Dashboard/Button/Primary.vue';
import VueMultiselect from 'vue-multiselect'

const props = defineProps({
    roles: Object,
    user: Object,
    userRoles: Object
});

let value =  ref(props.userRoles);

let form = useForm({
    _method: 'POST',
    roles: value,
    user_id: props.user.id
});

const updateProfileInformation = () => {
    if (value.value.length < 1) {
        return Notify.error(lang('users.roles.error.min'));
    }

    form.post(route('admin.users.syncRoles'), {
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
    <FormSection @submitted="updateProfileInformation">
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
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                {{$t('update')}}
            </PrimaryButton>
        </template>
    </FormSection>
</template>
