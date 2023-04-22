<script setup>
import { Link } from '@inertiajs/vue3';

import Item            from '@/Components/Dashboard/Help/Item.vue';
import PageHeader      from '@/Components/Dashboard/PageHeader.vue';
import Table           from '@/Components/Dashboard/Table.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

defineProps({
    users: String
});
</script>

<template>
  <DashboardLayout :title="$t('changelogs.title')">
    <PageHeader>
      <Link :href="route('dashboard.index')">
        <GoogleIcon
          class="btn-icon-primary"
          name="home"
          outline
        />
      </Link>
    </PageHeader>
    <div class="w-full px-6">
      <div class="mt-8">
        <p
          v-text="$t('changelogs.description')"
        />
      </div>
    </div>
    <div class="w-full">
      <Table :items="{total:1}">
        <template #head>
          <th
            class="table-item"
            v-text="$t('version')"
          />
          <th
            class="table-item"
            v-text="$t('description')"
          />
        </template>
        <template #body>
          <Item version="0.1.0">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>Inicio del proyecto.</li>
              </ul>
            </p>
          </Item>
        </template>
      </Table>
    </div>
  </DashboardLayout>
</template>
