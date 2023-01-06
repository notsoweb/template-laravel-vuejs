<script setup>
import GoogleIcon from '@/Components/Dashboard/GoogleIcon.vue';

defineProps({
  icon: String,
  version: String
});
</script>

<template>
  <tr class="text-gray-700">
    <td class="table-item border">
      <div class="flex items-center text-sm">
        <div class="flex justify-center text-center">
          <p v-if="icon" class="text-center text-black">
            <GoogleIcon
              class="text-2xl"
              :name="icon"
              outline
            />
          </p>
          <p 
            v-if="version"
            class="text-center text-black"
            v-text="version"
          />
        </div>
      </div>
    </td>
    <td class="table-item border">
      <div class="flex items-center text-sm">
        <slot />
      </div>
    </td>
  </tr>
</template>