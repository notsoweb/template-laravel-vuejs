<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/App/Table.vue';
import Item from '@/Components/App/Help/Item.vue';

defineProps({
    users: String
});

</script>
<template>
  <AppLayout :title="$t('changelogs.title')">
    <div class="w-full px-6 bg-white border-gray-200">
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
