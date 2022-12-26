<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLogo from '@/Components/App/Logo.vue';
import AuthenticationCard from '@/Components/App/AuthenticationCard.vue';
import Input from '@/Components/App/Form/Input.vue';
import PrimaryButton from '@/Components/App/Button/Primary.vue';

const props = defineProps({
    email: String,
    token: String
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: ''
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head
        title="Reset Password"
    />
    <AuthenticationCard>
        <template #logo>
            <AppLogo
                class="text-2xl"
            />
        </template>
        <form @submit.prevent="submit" class="space-y-4">
            <Input
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
                :onError="form.errors.email"
                required
                autofocus
            />
            <Input
                id="password"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password"
                :onError="form.errors.password"
                required
                autofocus
            />
            <Input
                id="passwordConfirmation"
                type="password"
                class="mt-1 block w-full"
                v-model="form.password_confirmation"
                :onError="form.errors.password_confirmation"
                required
                autofocus
            />
            <div class="flex items-center justify-end mt-4">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    v-text="$t('account.password.reset')"
                />
            </div>
        </form>
    </AuthenticationCard>
</template>
