<script setup>
import { onMounted, ref } from 'vue';
import { router, Link} from '@inertiajs/vue3';

import NotificationController from '@/Controllers/NotificationController';

import Dropdown         from '@/Components/Dashboard/Dropdown.vue';
import DropdownLink     from '@/Components/Dashboard/DropdownLink.vue';
import NotificationLink from '@/Components/Dashboard/Skeleton/Header/NotificationLink.vue';
import GoogleIcon       from '@/Components/Shared/GoogleIcon.vue';

// Eventos
const emit = defineEmits([
  'open'
]);

// Propiedades
const props = defineProps({
  sidebar: Boolean
});

// Controladores
const notificationCtl = NotificationController;

// Variables de controladores
const notificationCounter = ref(notificationCtl.counter);
const notifications = ref(notificationCtl.notifications);

// Otras variables
const userId = router.page.props.user.id;

// Métodos
const logout = () => {
  router.post(route('logout'), {}, {
    onBefore: () => {
      notificationCtl.stop();
    }
  });
};

onMounted(()=>{
  notificationCtl.start(userId);
});
</script>

<template>
    <header
      class="fixed px-2 w-[calc(100vw)] bg-white md:bg-transparent transition-all duration-300 z-50"
      :class="{'md:w-[calc(100vw-16rem)]':sidebar,'md:w-[calc(100vw)]':!sidebar}"
    >
      <div class="my-2 flex  px-6 items-center justify-between h-[2.75rem] rounded-lg bg-primary text-white z-20 ">
        <button type="button">
          <GoogleIcon
              class="text-xl z-50"
              name="menu"
              @click="emit('open')"
              outline
            />
        </button>
        <div class="flex w-fit justify-end items-center h-14 header-right">
          <ul class="flex items-center space-x-4">
            <li>
              <div class="relative">
                <Dropdown align="icon" width="72">
                  <template #trigger>
                    <button 
                      class="flex items-center header-icon"
                      type="button"
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
                            :readAt="notification.read_at"
                            @click="notificationCtl.show(notification.id)"
                          >
                            <span class="truncate">
                              {{notification.data.message}}
                            </span>
                          </NotificationLink>
                        </template>
                        <template v-if="notifications.length < 1">
                          <NotificationLink
                            as="button"
                            icon="notifications"
                          >
                            <span class="truncate">
                              {{ $t('noRecords') }}
                            </span>
                          </NotificationLink>
                        </template>
                      </div>
                      <div class="border-t border-gray-100" />
                      <Link :href="route('dashboard.notifications.index')" class="inline-flex w-full py-1 justify-center bg-primary hover:bg-secondary text-white transition">
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
      </div>
    </header>
</template>