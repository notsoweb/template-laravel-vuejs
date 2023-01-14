<script setup>
import { Link } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import GoogleIcon from '@/Components/Shared/GoogleIcon.vue';
import Item from '@/Components/Dashboard/Help/Item.vue';
import PageHeader from '@/Components/Dashboard/PageHeader.vue';
import Table from '@/Components/Dashboard/Table.vue';

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
      <Table>
        <template #head>
          <tr class="table-head">
            <th
              class="table-item"
              v-text="$t('version')"
            />
            <th
              class="table-item"
              v-text="$t('description')"
            />
          </tr>
        </template>
        <template #body>
          <Item version="0.0.4">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>Real-time notifications.</li>
                <li>Notification manager with search engine.</li>
              </ul>
            </p>
          </Item>
          <Item version="0.0.3">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>Translations on missing components.</li>
                <li>Separate logic from notifications in a service.</li>
                <li>Separate UseFetch logic in a trait.</li>
              </ul>
            </p>
          </Item>
          <Item version="0.0.2">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>Update user passwords.</li>
                <li>Allows to assign roles to the user.</li>
                <li>Report action to edit, delete, update roles and delete users.</li>
                <li>Create new users.</li>
                <li>Create and edit roles.</li>
              </ul>
            </p>
          </Item>
          <Item version="0.0.1">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>Structuring of the template.</li>
                <li>Simple event-driven change history.</li>
              </ul>
            </p>
          </Item>
        </template>
      </Table>
    </div>
  </DashboardLayout>
</template>
