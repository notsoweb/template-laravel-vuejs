<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/App/Table.vue';
import Item from '@/Components/App/Help/Item.vue';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';
import PageHeader from '@/Components/App/PageHeader.vue';

defineProps({
    users: String
});

</script>
<template>
  <AppLayout :title="$t('changelogs.title')">
    <PageHeader>
      <Link :href="route('dashboard')">
          <GoogleIcon class="btn-icon-primary" name="home" outline />
      </Link>
    </PageHeader>
    <div class="w-full px-6">
      <div class="mt-8">
        <p v-text="$t('changelogs.description')" />
      </div>
    </div>
    <div class="w-full">
      <Table>
        <template #head>
          <tr class="table-head">
            <th class="table-item" v-text="$t('version')" />
            <th class="table-item" v-text="$t('description')" />
          </tr>
        </template>
        <template #body>
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
  </AppLayout>
</template>
