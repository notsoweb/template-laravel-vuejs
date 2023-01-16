<script setup>
import { ref } from 'vue';
import { Link, router} from '@inertiajs/vue3'
import { hasRole }  from '@/rolePermission.js';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import Icon from '@/Components/Shared/GoogleIcon.vue';
import IconPrimary from '@/Components/Dashboard/Button/Primary.vue';
import Input from '@/Components/Dashboard/Form/Input.vue';
import Item from '@/Components/Dashboard/Help/Item.vue';
import PageHeader from '@/Components/Dashboard/PageHeader.vue';
import Table from '@/Components/Dashboard/Table.vue';

defineProps({
  users: String,
  histories: Object
});

let dateStart = ref('');
let dateEnd = ref('');
let historyEvent = ref('');

const formatDate = (date) => {
  let x = new Date(date);
  
  return x.toLocaleDateString('es-MX');
}

const formatTime = (date) => {
  let x = new Date(date);

  return x.toLocaleTimeString('es-MX'); 
}

const search = () => {
  router.get(route('dashboard.histories.index', {
    historyEvent:historyEvent.value,
    dateStart:dateStart.value,
    dateEnd:dateEnd.value
  }), {}, {
    preserveState: true
  });
}

const searchWithPagination = (page) =>  {
  router.get(route('dashboard.histories.index', {
    historyEvent:historyEvent.value,
    dateStart:dateStart.value,
    dateEnd:dateEnd.value,
    page:page
  }), {}, {
    preserveState: true
  });
}
</script>
<template>
  <DashboardLayout :title="$t('history.title')">
    <PageHeader>
      <Link :href="route('dashboard.index')">
        <Icon
          class="btn-icon-primary"
          name="home"
          outline
        />
      </Link>
    </PageHeader>
    <div class="w-full  bg-white border-gray-200">
      <div class="mt-8">
        <p v-text="$t('history.description')" />
      </div>
    </div>
    <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
      <div v-if="hasRole('admin|developer')">
        <Input
          id="search"
          title="event"
          v-model="historyEvent"
          @keyup.enter="search"
          required
          autocomplete="off"
        />
      </div>
      <div>
        <Input
          id="startDate"
          v-model="dateStart"
          type="date"
          @keyup.enter="search"
          autocomplete="off"
        />
      </div>
      <div>
        <Input
          id="endDate"
          v-model="dateEnd"
          type="date"
          @keyup.enter="search"
          autocomplete="off"
        />
      </div>
      <div class="flex items-end">
        <IconPrimary
          class="w-full"
          @click="search"
        >
          {{$t('search')}}
        </IconPrimary>
      </div>
    </div>
    <div class="w-full">
      <Table :links="histories.links"  @send-pagination="searchWithPagination">
        <template #head>
          <tr class="table-head">
            <th
              class="table-item"
              v-text="$t('event')"
            />
            <th
              class="table-item"
              v-text="$t('description')"
            />
          </tr>
        </template>
        <template #body>
          <template v-for="history in histories.data">
            <Item :version="history.action">
              <div class="flex flex-col space-y-2">
                <div>
                  <p class="font-semibold text-black">
                    <b>{{$t('date')}}:</b> {{ formatDate(history.created_at) }}
                  </p>
                  <p class="font-semibold text-black">
                    <b>{{$t('hour')}}:</b> {{ formatTime(history.created_at) }}
                  </p>
                  <p class="font-semibold text-black">
                    <b>{{$t('user')}}:</b> {{ history.name }} {{ history.paternal }} {{ history.maternal }}
                  </p>
                </div>
                <p class="font-semibold text-black">
                  <p><b>{{$t('description')}}:</b></p>
                  {{ history.message }}
                </p>
              </div>
            </Item>
          </template>
          <tr v-if="histories.total < 1" class="text-gray-700">
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
  </DashboardLayout>
</template>
