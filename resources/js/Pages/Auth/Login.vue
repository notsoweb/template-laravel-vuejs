<script setup>
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import AppLogo from '@/Components/App/Logo.vue';
import AuthenticationCard from '@/Components/App/AuthenticationCard.vue';
import Checkbox from '@/Components/App/Form/Checkbox.vue';
import Input from '@/Components/App/Form/Input.vue';
import PrimaryButton from '@/Components/App/Button/Primary.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
<template>
    <Head :title="$t('auth.login')" />

    <AuthenticationCard>
        <template #logo>
            <AppLogo class="text-2xl"/>
        </template>

        <div v-if="status"
            class="mb-4 font-medium text-sm text-green-600"
        >
            {{status}}
        </div>

        <form @submit.prevent="submit" class="space-y-4">
            <Input
                id="email"
                type="email"
                v-model="form.email"
                :onError="form.errors.email"
                autofocus
                required
            />
            <Input
                id="password"
                type="password"
                v-model="form.password"
                :onError="form.errors.password"
                required
            />
            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox v-model:checked="form.remember" name="remember" />
                    <span
                        class="ml-2 text-sm text-gray-600"
                        v-text="$t('auth.remember')"
                    />
                </label>
            </div>
            <div class="flex flex-col items-center justify-end space-y-4 mt-4">
                <PrimaryButton
                    class="ml-4 w-full"
                    :class="{ 'opacity-25': form.processing }" 
                    :disabled="form.processing"
                    v-text="$t('auth.login')"
                />
                <Link v-if="canResetPassword"
                    class="underline text-sm text-gray-600 hover:text-gray-900" 
                    :href="route('password.request')" 
                >
                    {{ $t('auth.forgotPassword.ask') }}
                </Link>
            </div>
        </form>
    </AuthenticationCard>
</template>
