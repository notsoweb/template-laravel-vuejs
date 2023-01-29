<script setup>
import { hasRole } from "@/rolePermission.js"

import Logo    from '@/Components/Dashboard/Logo.vue';
import Link    from  './Sidebar/Link.vue';
import Section from  './Sidebar/Section.vue';

const emit = defineEmits(['open']);

const props = defineProps({
  sidebar: Boolean
});

const year = (new Date).getFullYear();
</script>

<template>
  <nav class="flex w-screen md:w-64 bg-transparent h-full transition-all duration-300 border-none">
    <div class="flex flex-col h-full md:w-64">
      <div class="flex w-64 mt-14 md:mt-0 justify-start items-center h-14 header-right bg-primary text-white">
          <ul class="flex justify-center ml-4 md:mt-0 space-x-4 items-center">
            <li>
              <Logo
                class="text-lg inline-flex"
              />
            </li>
          </ul>
      </div>
      <div class="flex h-full flex-col w-64 justify-between flex-grow overflow-y-auto overflow-x-hidden bg-primary text-white">
        <ul class="flex h-full flex-col md:py-4 space-y-1">
          <Section name="Principal">
            <Link 
              icon="home"
              name="home" 
              to="dashboard.index"
            />
            <Link
              icon="live_help"
              name="help.title"
              to="dashboard.help"
            />
          </Section>
          <Section name="Configuraciones">
            <Link 
              icon="manage_accounts"
              name="profile"
              to="profile.show"
            />
            <Link
              icon="history_toggle_off"
              name="history.title"
              to="dashboard.histories.index"
            />
          </Section>
          <template v-if="hasRole('admin|developer')">
            <Link 
              icon="people"
              name="users.title"
              to="admin.users.index"
            />
            <Link
              icon="history"
              name="changelogs.title"
              to="dashboard.changelogs"
            />
          </template>
          <template v-if="hasRole('developer')">
            <Section name="Sistema">
              <Link
                icon="people"
                name="roles.title"
                to="developer.roles.index"
              />
            </Section>
            </template>
        </ul>
        <div class="mb-4 px-5 space-y-1">
          <p class="block text-center text-xs">
            &copy {{year}} {{$page.props.copyright}}
          </p>
          <p 
            class="block text-center text-xs"
            v-text="$t('copyright')"
          />
          <p class="text-center text-xs text-yellow-500 cursor-pointer">
              V{{$page.version}}
          </p>
        </div>
      </div>
    </div>
    <div
      class="h-full bg-transparent"
      :class="{'md:w-0':sidebar,'w-full md:w-0':!sidebar}"
      @click="emit('open')" 
    ></div>
  </nav>
</template>