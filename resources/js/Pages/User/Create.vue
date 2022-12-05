<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';
import PageHeader from '@/Components/App/PageHeader.vue';
import Input from '@/Components/App/Form/Input.vue';
import PrimaryButton from '@/Components/App/Button/Primary.vue';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    users: String,
    password: String
});

const form = useForm({
    name: '',
    paternal: '',
    maternal: '',
    email: '',
    phone: '',
    password: '',
});

const submit = () => {
    form.post(route('users.store'), {
        onSuccess: (res) => {
            Notify.success(lang('users.create.onSuccess'));
        },
        onError: () => Notify.success(lang('users.create.onError')),
        onFinish: (res) => form.reset('password'),
    });
};

</script>
<template>
  <AppLayout :title="$t('users.create.title')">
    <PageHeader>
      <Link :href="route('dashboard')">
          <GoogleIcon class="btn-icon-primary" name="home" outline />
      </Link>
    </PageHeader>
    <div class="w-full pb-8">
      <div class="mt-8">
        <p v-text="$t('users.create.description')" />
      </div>
    </div>
    <div class="w-full">
        <form @submit.prevent="submit" class="grid gap-4 grid-cols-6">
            <Input
                id="name"
                class="col-span-2"
                v-model="form.name"
                :onError="form.errors.name"
                autofocus
                required
            />
            <Input
                id="paternal"
                class="col-span-2"
                v-model="form.paternal"
                :onError="form.errors.paternal"
                autofocus
                required
            />
            <Input
                id="maternal"
                class="col-span-2"
                v-model="form.maternal"
                :onError="form.errors.maternal"
                autofocus
            />
            <Input
                id="phone"
                class="col-span-2"
                v-model="form.phone"
                :onError="form.errors.phone"
                autofocus
                required
            />
            <Input
                id="email"
                type="email"
                class="col-span-2"
                v-model="form.email"
                :onError="form.errors.email"
                autofocus
                required
            />
            <Input
                id="password"
                type="password"
                class="col-span-2"
                v-model="form.password"
                :onError="form.errors.password"
                required
            />
            <div class="col-span-6 flex flex-col items-center justify-end space-y-4 mt-4">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }" 
                    :disabled="form.processing"
                    v-text="$t('users.create.title')"
                />
            </div>
        </form>
    </div>
  </AppLayout>
</template>
