<script setup>
import { ref } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import ActionMessage from '@/Components/App/ActionMessage.vue';
import FormSection from '@/Components/App/FormSection.vue';
import Label from '@/Components/App/Form/Elements/Label.vue';
import Error from '@/Components/App/Form/Elements/Error.vue';
import PrimaryButton from '@/Components/App/Button/Primary.vue';
import SecondaryButton from '@/Components/App/Button/Secondary.vue';
import Input from '@/Components/App/Form/Input.vue';

const props = defineProps({
    user: Object,
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    paternal: props.user.paternal,
    maternal: props.user.maternal,
    phone: props.user.phone,
    email: props.user.email,
    photo: null,
});

const verificationLinkSent = ref(null);
const photoPreview = ref(null);
const photoInput = ref(null);

const updateProfileInformation = () => {
    if (photoInput.value) {
        form.photo = photoInput.value.files[0];
    }

    form.post(route('user-profile-information.update'), {
        errorBag: 'updateProfileInformation',
        preserveScroll: true,
        onSuccess: () => clearPhotoFileInput(),
    });
};

const sendEmailVerification = () => {
    verificationLinkSent.value = true;
};

const selectNewPhoto = () => {
    photoInput.value.click();
};

const updatePhotoPreview = () => {
    const photo = photoInput.value.files[0];

    if (! photo) return;

    const reader = new FileReader();

    reader.onload = (e) => {
        photoPreview.value = e.target.result;
    };

    reader.readAsDataURL(photo);
};

const deletePhoto = () => {
    Inertia.delete(route('current-user-photo.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            photoPreview.value = null;
            clearPhotoFileInput();
        },
    });
};

const clearPhotoFileInput = () => {
    if (photoInput.value?.value) {
        photoInput.value.value = null;
    }
};
</script>

<template>
    <FormSection @submitted="updateProfileInformation">
        <template #title>
            {{$t('account.profile.title')}}
        </template>

        <template #description>
            {{$t('account.profile.description')}}
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.props.jetstream.managesProfilePhotos" class="col-span-6">
                <!-- Profile Photo File Input -->
                <input
                    ref="photoInput"
                    type="file"
                    class="hidden"
                    @change="updatePhotoPreview"
                >

                <Label id="photo" title="photo.title" />

                <!-- Current Profile Photo -->
                <div v-show="! photoPreview" class="mt-2">
                    <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span
                        class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        :style="'background-image: url(\'' + photoPreview + '\');'"
                    />
                </div>

                <SecondaryButton
                    class="mt-2 mr-2"
                    type="button"
                    @click.prevent="selectNewPhoto" 
                    v-text="$t('photo.new')"
                />

                <SecondaryButton v-if="user.profile_photo_path"
                    type="button"
                    class="mt-2"
                    @click.prevent="deletePhoto"
                >
                    {{$t('photo.remove')}}
                </SecondaryButton>

                <Error :onError="form.errors.photo"/>
            </div>

            <Input
                id="name"
                class="col-span-6"
                v-model="form.name"
                :onError="form.errors.name"
                required
            />
            <Input
                id="paternal"
                class="col-span-6"
                v-model="form.paternal"
                :onError="form.errors.paternal"
                required
            />
            <Input
                id="maternal"
                class="col-span-6"
                v-model="form.maternal"
                :onError="form.errors.maternal"
                required
            />

            <Input
                id="phone"
                class="col-span-6"
                type=" number"
                v-model="form.phone"
                :onError="form.errors.phone"
                required
            />

            <Input
                id="email"
                class="col-span-6"
                type="email"
                v-model="form.email"
                :onError="form.errors.email"
                required
            />
            <div class="col-span-6">
                <div v-if="$page.props.jetstream.hasEmailVerification && user.email_verified_at === null">
                    <p class="text-sm mt-2">
                        {{$t('account.email.unverify')}}

                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-gray-600 hover:text-gray-900"
                            @click.prevent="sendEmailVerification"
                        >
                            {{$t('account.email.sendVerification')}}
                        </Link>
                    </p>

                    <div v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{$t('account.email.notifySendVerification')}}
                    </div>
                </div>
            </div>
        </template>
        <template #actions>
            <ActionMessage
                class="mr-3"
                :on="form.recentlySuccessful"
            >
                {{$t('saved')}}
            </ActionMessage>
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
                v-text="$t('save')"
            />
        </template>
    </FormSection>
</template>
