<script setup>
import { router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { UnsuscribeUserAuth } from '@/broadcasts.js';
import NotificationLink from  '@/Components/App/Skeleton/Header/NotificationLink.vue';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';
import LogoIcon from '@/Components/App/Logo/Icon.vue';
import Logo from '@/Components/App/Logo.vue';
import Dropdown from '@/Components/App/Dropdown.vue';
import DropdownLink from '@/Components/App/DropdownLink.vue';

const logout = () => {
    router.post(route('logout'), {}, {
      onBefore: () => {
        sessionFresh.stop();
        UnsuscribeUserAuth()
      }
    });
};
</script>
<template>
    <!-- Header -->
    <header class="fixed w-full flex items-center justify-between h-14 bg-primary text-primary-text z-10">
      <div class="flex w-fit justify-start items-center h-14 header-right">
        <ul class="flex ml-4 space-x-4 items-center">
          <li>
            <LogoIcon class="text-lg md:hidden" />
            <Logo class="text-lg hidden md:inline-flex" />
          </li>
        </ul>
      </div>
      <div class="flex w-fit justify-end items-center h-14 header-right">
        <ul class="flex items-center space-x-4 mr-4">
          <li>
            <button type="button" class="flex items-center header-icon-primary">
              <GoogleIcon name="group" class="text-xl" />
            </button>
          </li>
          <li class="">
            <div class="relative">
              <Dropdown align="icon" width="72">
                <template #trigger>
                  <button type="button" class="flex items-center header-icon-primary">
                    <GoogleIcon name="notifications" class="text-xl" />
                  </button>
                </template>
                <template #content>
                    <div class="block px-4 py-2 text-xs">
                        <p class="text-center font-bold text-black">{{$t('notifications.title')}}</p>
                    </div>
                    <div class="w-full">
                      <NotificationLink :href="route('profile.show')" icon="add">
                          <span class="truncate">Example notification Example notification </span>
                      </NotificationLink>
                      <NotificationLink :href="route('profile.show')">
                        <span class="truncate">Example notification</span>
                      </NotificationLink>
                      <NotificationLink :href="route('profile.show')">
                        <span class="truncate">Example notification</span>
                      </NotificationLink>
                    </div>
                    <div class="border-t border-gray-100" />
                    <Link :href="route('profile.show')" class="inline-flex w-full py-1 justify-center bg-primary hover:bg-primary-hover text-primary-text transition">
                        {{$t('show.all')}}
                    </Link>
                </template>
              </Dropdown>
            </div>
          </li>
          <li class="">
            <div class="relative">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <div class="flex space-x-4">
                    <button v-if="$page.props.jetstream.managesProfilePhotos" class="flex items-center space-x-4 text-sm border-2 border-transparent rounded-full focus:outline-none transition">
                        <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name">
                        <span class="flex">{{ $page.props.user.name }}
                          <svg
                              class="ml-2 -mr-0.5 h-4 w-4"
                              xmlns="http://www.w3.org/2000/svg"
                              viewBox="0 0 20 20"
                              fill="currentColor"
                          >
                              <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                          </svg>
                        </span>
                    </button>
                  </div>
                </template>
                <template #content>
                    <div class="block px-4 py-2 text-xs text-gray-400">
                         {{$t('account.manage')}}
                    </div>
                    <DropdownLink :href="route('profile.show')">
                         {{$t('profile')}}
                    </DropdownLink>
                    <DropdownLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                      API Tokens
                    </DropdownLink>
                    <div class="border-t border-gray-100" />
                    <form @submit.prevent="logout">
                        <DropdownLink as="button">
                             {{$t('auth.logout')}}
                        </DropdownLink>
                    </form>
                </template>
              </Dropdown>
            </div>
          </li>
        </ul>
      </div>
    </header>
    <!-- ./Header -->
</template>