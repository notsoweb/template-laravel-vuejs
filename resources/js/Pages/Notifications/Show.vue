<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import GoogleIcon from '@/Components/Shared/GoogleIcon.vue';
import PageHeader from '@/Components/Dashboard/PageHeader.vue';

defineProps({
  notification: Object,
  users: String
});

const formatDate = (date) => {
  let x = new Date(date);
  
  return x.toLocaleDateString('es-MX');
}

const formatTime = (date) => {
  let x = new Date(date);

  return x.toLocaleTimeString('es-MX'); 
}

</script>
<template>
  <AppLayout :title="$t('notifications.title')">
    <PageHeader>
      <Link :href="route('dashboard')">
          <GoogleIcon
            class="btn-icon-primary"
            name="home"
            outline
          />
      </Link>
    </PageHeader>
    <div class="w-full grid sm:grid-cols-2 lg:grid-cols-4 mt-8">
      <div class="bg-primary text-white text-center">
          <p class="p-2">
            {{$t('date')}}
          </p>
      </div>
      <div class="text-center border border-primary">
          <p class="p-2">
            {{ formatDate(notification.created_at) }}
          </p>
      </div>
      <div class="bg-primary text-white text-center">
          <p class="p-2">
            {{$t('hour')}}
          </p>
      </div>
      <div class="text-center border border-primary">
          <p class="p-2">
            {{ formatTime(notification.created_at) }}
          </p>
      </div>
    </div>
    <div class="flex flex-col w-full justify-center items-center space-y-6">
      <div class="mt-8">
        <GoogleIcon
          class="btn-icon-primary text-7xl"
          :name="notification.data.icon"
          outline
        />
      </div>
      <div>
        {{notification.data.message}}
      </div>
    </div>
    <div class="flex justify-center mt-8">
        <Link :href="route('notifications.index')" class="inline-flex w-fit py-1 px-4 justify-center bg-primary hover:bg-primary-hover text-primary-text rounded-lg transition">
            {{$t('show.all')}}
        </Link>
    </div>
  </AppLayout>
</template>
