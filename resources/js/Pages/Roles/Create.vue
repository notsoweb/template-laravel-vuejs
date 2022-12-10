<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';
import PageHeader from '@/Components/App/PageHeader.vue';
import Input from '@/Components/App/Form/Input.vue';
import PrimaryButton from '@/Components/App/Button/Primary.vue';

const form = useForm({
    name: '',
    description: ''
});

const submit = () => {
    form.post(route('roles.store'), {
        onSuccess: (res) => {
            Notify.success(lang('roles.create.onSuccess'));
        },
        onError: () => Notify.success(lang('roles.create.onError'))
    });
};

</script>
<template>
  <AppLayout :title="$t('roles.create.title')">
    <PageHeader>
      <Link :href="route('dashboard')">
          <GoogleIcon class="btn-icon-primary" name="home" outline />
      </Link>
    </PageHeader>
    <div class="w-full pb-8">
      <div class="mt-8">
        <p v-text="$t('roles.create.description')" />
      </div>
    </div>
    <div class="w-full">
        <form @submit.prevent="submit" class="grid gap-4 grid-cols-6">
            <Input
                id="name"
                class="col-span-3"
                v-model="form.name"
                :onError="form.errors.name"
                autofocus
                required
            />
            <Input
                id="description"
                class="col-span-3"
                v-model="form.description"
                :onError="form.errors.description"
                autofocus
                required
            />
            <div class="col-span-6 flex flex-col items-center justify-end space-y-4 mt-4">
                <PrimaryButton
                    :class="{ 'opacity-25': form.processing }" 
                    :disabled="form.processing"
                    v-text="$t('roles.create.title')"
                />
            </div>
        </form>
    </div>
  </AppLayout>
</template>
