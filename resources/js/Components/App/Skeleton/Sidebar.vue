<script setup>
  import {hasRole} from "@/rolePermission.js"
  import Link from  './Sidebar/Link.vue';
  import Section from  './Sidebar/Section.vue';
</script>
<template>
  <!-- Sidebar -->
  <div class="fixed flex flex-col top-14 left-0 w-14 hover:w-64 md:w-64 bg-primary h-full text-primary-text transition-all duration-300 border-none">
    <div class="overflow-y-auto overflow-x-hidden flex flex-col justify-between flex-grow">
      <ul class="flex flex-col py-4 space-y-1">
        <Section name="Principal">
          <Link name="home"  icon="home" to="dashboard" />
          <Link name="help.title" icon="live_help" to="help.index"/>
        </Section>
        <Section name="Configuraciones">
          <Link name="profile"  icon="manage_accounts" to="profile.show"/>
          <Link name="history.title"  icon="history_toggle_off" to="histories.index"/>
        </Section>
        <template v-if="hasRole('admin|developer')">
          <Link name="users.title"  icon="people" to="users.index"/>
          <Link name="roles.title"  icon="people" to="roles.index"/>
          <Link name="changelogs.title"  icon="history" to="changelogs.index"/>
        </template>
      </ul>
      <div class="mb-16 px-5 space-y-2">
        <p class="hidden md:block text-center text-xs">@2022 Golsystems <a class="text-yellow-500 cursor-pointer">V{{$page.version}}</a></p>
        <p class="hidden md:block text-center text-xs" v-text="$t('copyright')" />
      </div>
    </div>
  </div>
</template>