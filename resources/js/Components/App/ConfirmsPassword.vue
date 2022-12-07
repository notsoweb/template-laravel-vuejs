<script setup>
import { ref, reactive, nextTick } from 'vue';
import DialogModal from './DialogModal.vue';
import PrimaryButton from '@/Components/App/Button/Primary.vue';
import SecondaryButton from './SecondaryButton.vue';
import Input from './Form/Input.vue';

const emit = defineEmits(['confirmed']);

defineProps({
    title: {
        type: String,
        default: 'passwordConfirmation',
    },
    content: {
        type: String,
        default: 'account.password.verify',
    },
    button: {
        type: String,
        default: 'confirm',
    },
});

const confirmingPassword = ref(false);

const form = reactive({
    password: '',
    error: '',
    processing: false,
});

const passwordInput = ref(null);

const startConfirmingPassword = () => {
    axios.get(route('password.confirmation')).then(response => {
        if (response.data.confirmed) {
            emit('confirmed');
        } else {
            confirmingPassword.value = true;

            setTimeout(() => passwordInput.value.focus(), 250);
        }
    });
};

const confirmPassword = () => {
    form.processing = true;

    axios.post(route('password.confirm'), {
        password: form.password,
    }).then(() => {
        form.processing = false;

        closeModal();
        nextTick().then(() => emit('confirmed'));

    }).catch(error => {
        form.processing = false;
        form.error = error.response.data.errors.password[0];
        passwordInput.value.focus();
    });
};

const closeModal = () => {
    confirmingPassword.value = false;
    form.password = '';
    form.error = '';
};
</script>
<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot />
        </span>
        <DialogModal :show="confirmingPassword" @close="closeModal">
            <template #title>
                {{ $t(title) }}
            </template>
            <template #content>
                {{ $t(content) }}
                <div class="mt-4">
                    <Input
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        :onError="form.error"
                        type="password"
                        class="mt-1 block w-3/4"
                        @keyup.enter="confirmPassword"
                    />
                </div>
            </template>
            <template #footer>
                <SecondaryButton @click="closeModal">
                     {{$t('cancel')}}
                </SecondaryButton>
                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="confirmPassword"
                >
                    {{ $t(button) }}
                </PrimaryButton>
            </template>
        </DialogModal>
    </span>
</template>
