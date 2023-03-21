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
          <Item version="1.0.0">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>Stable version</li>
              </ul>
            </p>
          </Item>
          <Item version="0.2.5">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>FIX: User Secure Logging.</li>
                <li>FIX: Notifications.</li>
                <li>FIX: Selectable.</li>
              </ul>
            </p>
          </Item>
          <Item version="0.2.4">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>Search controllers and trays.</li>
                <li>See what change in the history.</li>
                <li>Minor corrections.</li>
              </ul>
            </p>
          </Item>
          <Item version="0.2.3">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>Roles & permissions.</li>
                <li>Screen detector.</li>
                <li>Updated laravel 9 to 10.</li>
              </ul>
            </p>
          </Item>
          <Item version="0.2.2">
            <p class="font-semibold text-black">
              <ul class="list-disc list-inside">
                <li>Send notifications by console.</li>
                <li>Intelligent menu design.</li>
                <li>Optimization for mobile devices.</li>
                <li>Screen size recognition.</li>
                <li>Hide menu when desired.</li>
                <li>Isolate template for the implementation of a second or more templates.</li>
                <li>Safe maintenance mode.</li>
              </ul>
            </p>
          </Item>
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
