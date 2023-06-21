<script setup>
import { Link } from '@inertiajs/vue3';

import PageHeader      from '@/Components/Dashboard/PageHeader.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

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
  <DashboardLayout :title="$t('notifications.title')">
    <PageHeader />
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
        <Link :href="route('dashboard.notifications.index')" class="inline-flex w-fit py-1 px-4 justify-center bg-primary hover:bg-secondary text-white rounded-lg transition">
          {{$t('show.all')}}
        </Link>
    </div>
  </DashboardLayout>
</template>
