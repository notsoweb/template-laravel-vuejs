<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import GoogleIcon from '@/Components/App/GoogleIcon.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Roles from './Roles.vue';
import UpdatePassword from './UpdatePassword.vue';
import PageHeader from '@/Components/App/PageHeader.vue';
import SectionBorder from '@/Components/App/SectionBorder.vue';

const props = defineProps({
    user: Object,
    userRoles: Object,
    roles: Object
});
</script>  
<template>
    <AppLayout :title="$t('users.settings')">
        <PageHeader>
          <Link :href="route('users.index')">
              <GoogleIcon class="btn-icon-primary" name="arrow_back" outline />
          </Link>
        </PageHeader>
        <div class="flex w-full pt-2">
            <div class="w-full text-center p-2 bg-gray-800 border-b rounded-lg">
                <p class="pt-2 text-lg font-bold text-gray-50">{{user.name}}</p>
                <p class="text-sm text-gray-100">{{user.paternal}}  {{user.maternal}}</p>
            </div>
        </div>
        <div class="w-full mt-12 space-y-4">
            <UpdatePassword
                :user="user"
            />
            <SectionBorder />
            <Roles
                :user="user"
                :userRoles="userRoles"
                :roles="roles"
            />
            <SectionBorder />
        </div>
    </AppLayout>
</template>
    