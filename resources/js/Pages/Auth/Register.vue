<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AppLogo from '@/Components/App/Logo.vue';
import AuthenticationCard from '@/Components/App/AuthenticationCard.vue';
import Checkbox from '@/Components/App/Form/Checkbox.vue';
import InputLabel from '@/Components/App/InputLabel.vue';
import Input from '@/Components/App/Form/Input.vue';
import OnError from '@/Components/App/Form/Elements/Error.vue';
import PrimaryButton from '@/Components/App/Button/Primary.vue';

const form = useForm({
    name: '',
    paternal: '',
    maternal: '',
    email: '',
    phone: '',
    password: '',
    password_confirmation: '',
    terms: false
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AppLogo
                class="text-2xl"
            />
        </template>

        <form @submit.prevent="submit" class="space-y-4">
            <Input
                id="name"
                v-model="form.name"
                :onError="form.errors.name"
                required
                autofocus
            />
            <Input
                id="paternal"
                v-model="form.paternal"
                :onError="form.errors.paternal"
                required
            />
            <Input
                id="maternal"
                v-model="form.maternal"
                :onError="form.errors.maternal"
            />
            <Input
                id="phone"
                type="number"
                v-model="form.phone"
                :onError="form.errors.phone"
            />
            <Input
                id="email"
                type="email"
                v-model="form.email"
                :onError="form.errors.email"
                required
            />
            <Input
                id="password"
                type="password"
                v-model="form.password"
                :onError="form.errors.password"
                required
            />
            <Input
                id="passwordConfirmation"
                type="password"
                v-model="form.password_confirmation"
                :onError="form.errors.password_confirmation"
                required
            />

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                <InputLabel for="terms">
                    <div class="flex items-center">
                        <Checkbox
                            id="terms"
                            name="terms"
                            v-model:checked="form.terms"
                        />
                        <div class="ml-2">
                            {{$t('I agree to the')}}
                            <a 
                                target="_blank"
                                :href="route('terms.show')"
                                class="underline text-sm text-gray-600 hover:text-gray-900"
                            >
                                    {{$t('Terms of Service')}}
                            </a>
                            {{$t('and')}}
                            <a
                                target="_blank"
                                :href="route('policy.show')"
                                class="underline text-sm text-gray-600 hover:text-gray-900"
                            >
                                {{$t('Privacy Policy')}}
                            </a>
                        </div>
                    </div>
                    <OnError
                        :onError="form.errors.terms"
                    />
                </InputLabel>
            </div>

            <div class="flex flex-col items-center justify-end space-y-4 mt-4">
                <PrimaryButton
                    class="ml-4 w-full"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{$t('Register')}}
                </PrimaryButton>

                <Link :href="route('login')" class="underline text-sm text-gray-600 hover:text-gray-900">
                    {{$t('auth.register.already')}}
                </Link>
            </div>
        </form>
    </AuthenticationCard>
</template>
