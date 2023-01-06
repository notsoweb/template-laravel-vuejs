<script setup>
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import GoogleIcon from '@/Components/Dashboard/GoogleIcon.vue';
import PageHeader from '@/Components/Dashboard/PageHeader.vue';
import SectionBorder from '@/Components/Dashboard/SectionBorder.vue';
import Roles from './Roles.vue';
import UpdatePassword from './UpdatePassword.vue';

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
              <GoogleIcon
                class="btn-icon-primary"
                name="arrow_back"
                outline
              />
          </Link>
        </PageHeader>
        <div class="flex w-full pt-2">
            <div class="w-full text-center p-2 bg-gray-800 border-b rounded-lg">
                <p class="pt-2 text-lg font-bold text-gray-50">
                    {{user.name}}
                </p>
                <p class="text-sm text-gray-100">
                    {{user.paternal}}  {{user.maternal}}
                </p>
            </div>
        </div>
        <div class="w-full mt-12 space-y-4">
            <UpdatePassword
                :user="user"
            />
            <SectionBorder />
            <Roles
                :roles="roles"
                :user="user"
                :userRoles="userRoles"
            />
            <SectionBorder />
        </div>
    </AppLayout>
</template>
    