<script setup>
import {useForm} from '@inertiajs/vue3';
import Input from '@/Components/App/Form/Input.vue';
import PrimaryButton from '@/Components/App/Button/Primary.vue';
import FormSection from '@/Components/App/FormSection.vue';

const props = defineProps({
    user: Object
});

let form = useForm({
    _method: 'POST',
    password: '',
    user_id: props.user.id
});

const updateProfileInformation = () => {
    form.post(route('users.password'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => {
            Notify.success('updated');
            form.reset();
        },
        onError: () => {
            Notify.error(lang('updateFail'));
        }
    });
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            {{$t('users.password.title')}}
        </template>
        <template #description>
            {{$t('users.password.description')}}
        </template>
        <template #form>
            <div class="col-span-6 sm:col-span-4 space-y-4">
                <Input
                    id="password"
                    title="account.password.new"
                    type="password"
                    v-model="form.password"
                    :onError="form.errors.password"
                    autocomplete="off"
                    required
                />
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
