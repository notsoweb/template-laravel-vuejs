<script setup>
import { nextTick, onMounted, ref } from 'vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AppLogo from '@/Components/Logo.vue';
import PrimaryButton from '@/Components/Button/Primary.vue';
import Input from '@/Components/Form/Input.vue';

const codeInput = ref(null);
const recovery = ref(false);
const recoveryCodeInput = ref(null);

const form = useForm({
    code: '',
    recovery_code: '',
});

const toggleRecovery = async () => {
    recovery.value ^= true;

    await nextTick();

    if (recovery.value) {
        recoveryCodeInput.value.focus();
        form.code = '';
    } else {
        codeInput.value.focus();
        form.recovery_code = '';
    }
};

const submit = () => {
    form.post(route('two-factor.login'));
};

onMounted(()=>{
    codeInput.value.focus();
});
</script>

<template>
    <Head :title="$t('account.twoFactor.title')" />

    <AuthenticationCard>
        <template #logo>
            <AppLogo class="text-2xl"/>
        </template>

        <div class="mb-4 text-sm text-gray-600">
            <template v-if="! recovery">
                {{$t('account.twoFactor.login.onAuth')}}
            </template>

            <template v-else>
                {{$t('account.twoFactor.login.onRecovery')}}
            </template>
        </div>

        <form @submit.prevent="submit">
            <div v-if="! recovery">
                <Input 
                    id="code"
                    ref="codeInput"
                    title="code"
                    type="number"
                    v-model="form.code"
                    :onError="form.errors.code"
                />
            </div>
            <div v-else>
                <Input 
                    id="recovery_code"
                    ref="recoveryCodeInput"
                    title="account.twoFactor.recovery.code"
                    type="number"
                    v-model="form.recovery_code"
                    :onError="form.errors.recovery_code"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer" @click.prevent="toggleRecovery">
                    <template v-if="! recovery">
                        {{$t('account.twoFactor.recovery.useCode')}}
                    </template>

                    <template v-else>
                        {{$t('account.twoFactor.recovery.useAuth')}}
                    </template>
                </button>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{$t('auth.login')}}
                </PrimaryButton>
            </div>
        </form>
    </AuthenticationCard>
</template>
