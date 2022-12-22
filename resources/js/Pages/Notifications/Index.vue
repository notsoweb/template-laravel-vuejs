<script setup>
import { ref } from 'vue';
import { router} from '@inertiajs/vue3'
import { Link } from '@inertiajs/vue3';
import { hasRole }  from '@/rolePermission.js';
import Icon from '@/Components/App/GoogleIcon.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/App/Table.vue';
import Input from '@/Components/App/Form/Input.vue';
import PageHeader from '@/Components/App/PageHeader.vue';
import IconPrimary from '@/Components/App/Button/Primary.vue';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';
import Destroy from './Destroy.vue';

defineProps({
  notifications: Object
});

let dateStart = ref('');
let dateEnd = ref('');
let destroyModal = ref(false);
let notification = ref(null);

const formatDate = (date) => {
  let x = new Date(date);
  
  return x.toLocaleDateString('es-MX');
}

const formatTime = (date) => {
  let x = new Date(date);

  return x.toLocaleTimeString('es-MX'); 
}

const search = () => {
  router.get(route('notifications.index', {
    dateStart:dateStart.value,
    dateEnd:dateEnd.value
  }), {}, {
    preserveState: true
  });
}

const searchWithPagination = (page) =>  {
  router.get(route('notifications.index', {
    dateStart:dateStart.value,
    dateEnd:dateEnd.value,
    page:page
  }), {}, {
    preserveState: true
  });
}

const edit = (detail) => {
    router.put(route('notifications.update', detail.id), {}, {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        Notify.success(lang('readed'));
      }
    });
}

const destroy = (detail) => {
    notification.value = detail;
    switchDestroyModal();
}

const switchDestroyModal = () => destroyModal.value = !destroyModal.value;
</script>
<template>
  <AppLayout :title="$t('notifications.title')">
    <PageHeader>
      <Link :href="route('dashboard')">
          <Icon class="btn-icon-primary" name="home" outline />
      </Link>
    </PageHeader>
    <div class="w-full  bg-white border-gray-200">
      <div class="mt-8">
        <p v-text="$t('notifications.description')" />
      </div>
    </div>
    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
      <div>
        <Input
          id="startDate"
          v-model="dateStart"
          type="date"
          autocomplete="off"
          @keyup.enter="search"
        />
      </div>
      <div>
        <Input
          id="endDate"
          v-model="dateEnd"
          type="date"
          autocomplete="off"
          @keyup.enter="search"
        />
      </div>
      <div class="flex items-end">
        <IconPrimary @click="search" class="w-full">{{$t('search')}} </IconPrimary>
      </div>
    </div>
    <div class="w-full">
      <Table :links="notifications.links"  @send-pagination="searchWithPagination">
        <template #head>
          <tr class="table-head">
            <th class="table-item" v-text="$t('description')" />
            <th class="table-item" v-text="$t('date')" />
            <th class="table-item" v-text="$t('status')" />
            <th class="table-item" v-text="$t('actions')" />
          </tr>
        </template>
        <template #body>
          <template v-for="notification in notifications.data">
            <tr>
              <td class="table-item border">
                <div class="flex items-center text-sm">
                  <div>
                    <p class="font-semibold text-black">
                      {{ notification.data.message }}
                    </p>
                  </div>
                </div>
              </td>
              <td class="table-item border">
                <div class="flex items-center text-sm">
                  <div>
                    <p class="font-semibold text-black">
                      <b>Fecha:</b> {{ formatDate(notification.created_at) }}
                    </p>
                    <p class="font-semibold text-black">
                      <b>Hora:</b> {{ formatTime(notification.created_at) }}
                    </p>
                  </div>
                </div>
              </td>
              <td class="table-item border">
                <div class="flex items-center text-sm">
                  <div>
                    <p v-if="notification.read_at" class="font-semibold text-white bg-success px-2 rounded-md">
                      {{ $t('readed') }}
                    </p>
                    <p v-else="notification.read_at" class="font-semibold text-white bg-info px-2 rounded-md">
                      {{ $t('unreaded') }}
                    </p>
                  </div>
                </div>
              </td>
              <td class="table-item border">
                  <div class="flex justify-center space-x-2">
                    <GoogleIcon
                        v-if="!notification.read_at"
                        class="btn-icon-primary"
                        name="mark_email_read"
                        outline
                        @click="edit(notification)"
                    />
                    <template v-if="hasRole('developer')">
                        <GoogleIcon
                            class="btn-icon-primary"
                            name="delete"
                            outline
                            @click="destroy(notification)"
                        />
                    </template>
                  </div>
                </td>
            </tr>
          </template>
          <tr v-if="notifications.total < 1" class="text-gray-700">
            <td class="table-item border">
              <div class="flex items-center text-sm">
                <div>
                  -
                </div>
              </div>
            </td>
            <td class="table-item border">
              <div class="flex items-center text-sm">
                <div>
                  {{$t('noRecords')}}
                </div>
              </div>
            </td>
          </tr>
        </template>
      </Table>
    </div>
    <Destroy
        :show="destroyModal"
        :notification="notification"
        @close="switchDestroyModal"
    />
  </AppLayout>
</template>
