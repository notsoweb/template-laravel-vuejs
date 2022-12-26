<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';
import Item from '@/Components/App/Help/Item.vue';
import PageHeader from '@/Components/App/PageHeader.vue';
import Table from '@/Components/App/Table.vue';

defineProps({
    users: String
});
</script>

<template>
  <AppLayout :title="$t('help.title')">
    <PageHeader>
      <Link :href="route('dashboard')">
        <GoogleIcon
          class="btn-icon-primary"
          name="home"
          outline
        />
      </Link>
    </PageHeader>
    <div class="w-full px-6 bg-white border-gray-200">
      <div class="mt-8">
        <p v-text="$t('help.description')"></p>
      </div>
    </div>
    <div class="w-full">
      <Table>
        <template #head>
          <tr class="table-head">
            <th
              class="table-item"
              v-text="$t('icon')"
            />
            <th
              class="table-item"
              v-text="$t('description')"
            />
          </tr>
        </template>
        <template #body>
          <Item icon="home">
            <p class="font-semibold text-black" v-text="$t('help.home')"/>
          </Item>
        </template>
      </Table>
    </div>
  </AppLayout>
</template>
  