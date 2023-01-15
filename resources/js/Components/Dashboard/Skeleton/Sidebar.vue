<script setup>
import { hasRole } from "@/rolePermission.js"
import Link from  './Sidebar/Link.vue';
import Section from  './Sidebar/Section.vue';
import GoogleIcon from '@/Components/Shared/GoogleIcon.vue';
import Logo from '@/Components/Dashboard/Logo.vue';
import LogoIcon from '@/Components/Shared/Logo/Icon.vue';

const emit = defineEmits(['open']);

const props = defineProps({
  sideber: Boolean
});

const year = (new Date).getFullYear();
</script>

<template>
  <div class="flex flex-col w-64 bg-primary h-full text-white transition-all duration-300 border-none">
    <div class="flex w-fit justify-start items-center h-14 header-right">
        <ul class="flex ml-4 space-x-4 items-center">
          <li>
            <LogoIcon
              class="text-lg md:hidden"
            />
            <Logo
              class="hidden text-lg md:inline-flex"
            />
          </li>
        </ul>
      </div>
    <div class="flex flex-col justify-between flex-grow overflow-y-auto overflow-x-hidden">
      <ul class="flex flex-col py-4 space-y-1">
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
        <p class="hidden md:block text-center text-xs">
          &copy {{year}} {{$page.props.copyright}}
        </p>
        <p 
          class="hidden md:block text-center text-xs"
          v-text="$t('copyright')"
        />
        <p class="text-center text-xs text-yellow-500 cursor-pointer">
            V{{$page.version}}
        </p>
      </div>
    </div>
  </div>
</template>