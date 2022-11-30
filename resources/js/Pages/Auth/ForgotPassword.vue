<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AppLogo from '@/Components/Logo.vue';
import PrimaryButton from '@/Components/Button/Primary.vue';
import Input from '@/Components/Form/Input.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head
        :title="$t('auth.forgotPassword.title')" 
    />

    <AuthenticationCard>
        <template #logo>
            <AppLogo class="text-2xl" />
        </template>

        <div class="mb-4 text-sm text-gray-600">
            {{$t('auth.forgotPassword.description')}}
        </div>

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit" class="flex flex-col space-y-4">
            <div>
                <Input
                    id="email"
                    type="email"
                    autofocus
                    required
                    v-model="form.email"
                    :onError="form.errors.email"
                />
            </div>
            <div class="flex items-center justify-end">
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{$t('auth.forgotPassword.sendLink')}}
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
