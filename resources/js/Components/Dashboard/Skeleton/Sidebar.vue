<script setup>
import { hasRole } from "@/rolePermission.js"
import Link from  './Sidebar/Link.vue';
import Section from  './Sidebar/Section.vue';
import GoogleIcon from '@/Components/Shared/GoogleIcon.vue';

const year = (new Date).getFullYear();
</script>

<template>
  <div class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-64 bg-primary h-full text-white transition-all duration-300 border-none">
    <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
      <ul class="flex flex-col py-4 space-y-1">
        <li class="px-5 md:hidden">
          <GoogleIcon
            class="text-xl"
            name="menu"
            outline
          />
        </li>
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
      <div class="mb-16 px-5 space-y-1">
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