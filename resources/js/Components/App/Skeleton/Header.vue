<script setup>
import { onMounted, reactive } from 'vue';
import { router, Link} from '@inertiajs/vue3';
import { SuscribeUserNotification, UnsuscribeUserAuth, UnsuscribeUserNotification } from '@/broadcasts.js';
import NotificationLink from  '@/Components/App/Skeleton/Header/NotificationLink.vue';
import Dropdown from '@/Components/App/Dropdown.vue';
import DropdownLink from '@/Components/App/DropdownLink.vue';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';
import Logo from '@/Components/App/Logo.vue';
import LogoIcon from '@/Components/App/Logo/Icon.vue';

const userId = router.page.props.user.id;
const notificationCounter = reactive(sessionFresh.getNotificationCounter());
let notifications = reactive(sessionFresh.getNotifications());

const getNotifications = () => {
  sessionFresh.updateNotifications();
}

const notification = (notification) => {
  getNotifications();
  Notify.flash(notification.message, notification.icon);
};

const showNotification = (id) => {
  router.post(route('notifications.store'), {
    id:id
  });
};

const logout = () => {
  router.post(route('logout'), {}, {
    onBefore: () => {
      sessionFresh.stop();
      UnsuscribeUserAuth();
      UnsuscribeUserNotification(userId);
    }
  });
};

onMounted(()=>{
  if (!sessionFresh.isHeaderInitialized()) {
    SuscribeUserNotification(userId, notification);
    sessionFresh.startHeader();
    sessionFresh.startUser(userId);
    sessionFresh.updateNotifications();
  }
});
</script>

<template>
    <header class="fixed w-full flex items-center justify-between h-14 bg-primary text-primary-text z-10">
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
      <div class="flex w-fit justify-end items-center h-14 header-right">
        <ul class="flex items-center space-x-4 mr-4">
          <li>
            <button type="button" class="flex items-center header-icon-primary">
              <GoogleIcon
                class="text-xl"
                name="group"
              />
            </button>
          </li>
          <li>
            <div class="relative">
              <Dropdown align="icon" width="72">
                <template #trigger>
                  <button 
                    class="flex items-center header-icon-primary"
                    type="button"
                    @click="getNotifications"
                  >
                    <GoogleIcon
                      class="text-xl"
                      name="notifications"
                    />
                  </button>
                  <span class="absolute top-0 -right-2 text-xs">
                    {{notificationCounter}}
                  </span>
                </template>
                <template #content>
                    <div class="block px-4 py-2 text-xs">
                        <p class="text-center font-bold text-black">{{$t('notifications.title')}}</p>
                    </div>
                    <div class="w-full">
                      <template v-for="notification in notifications">
                        <NotificationLink
                          as="button"
                          :icon="notification.data.icon"
                          @click="showNotification(notification.id)"
                        >
                          <span class="truncate">
                            {{notification.data.message}}
                          </span>
                        </NotificationLink>
                      </template>
                    </div>
                    <div class="border-t border-gray-100" />
                    <Link :href="route('notifications.index')" class="inline-flex w-full py-1 justify-center bg-primary hover:bg-primary-hover text-primary-text transition">
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
                        <img 
                          class="h-8 w-8 rounded-full object-cover"
                          :alt="$page.props.user.name"
                          :src="$page.props.user.profile_photo_url"
                        >
                        <span class="flex">{{ $page.props.user.name }}
                          <svg
                            class="ml-2 -mr-0.5 h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                          >
                            <path 
                              fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"
                            />
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
</template>