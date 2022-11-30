<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Table from '@/Components/Table.vue';
import Item from '@/Components/Help/Item.vue';

defineProps({
    users: String
});

</script>
<template>
  <AppLayout :title="$t('help.title')">
    <div class="w-full px-6 bg-white border-gray-200">
      <div class="mt-8">
        <p v-text="$t('help.description')"></p>
      </div>
    </div>
    <div class="w-full">
      <Table>
        <template #head>
          <tr class="table-head">
            <th class="table-item" v-text="$t('icon')" />
            <th class="table-item" v-text="$t('description')" />
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
  