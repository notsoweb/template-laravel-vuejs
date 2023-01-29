<script setup>
import { Link } from '@inertiajs/vue3';

import PageHeader                     from '@/Components/Dashboard/PageHeader.vue';
import SectionBorder                  from '@/Components/Dashboard/SectionBorder.vue';
import GoogleIcon                     from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout                from '@/Layouts/DashboardLayout.vue';
import DeleteUserForm                 from './Partials/DeleteUserForm.vue';
import LogoutOtherBrowserSessionsForm from './Partials/LogoutOtherBrowserSessionsForm.vue';
import TwoFactorAuthenticationForm    from './Partials/TwoFactorAuthenticationForm.vue';
import UpdatePasswordForm             from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm   from './Partials/UpdateProfileInformationForm.vue';

defineProps({
    confirmsTwoFactorAuthentication: Boolean,
    sessions: Array
});
</script>

<template>
    <DashboardLayout :title="$t('profile')">
        <PageHeader>
          <Link :href="route('dashboard.index')">
            <GoogleIcon
              class="btn-icon-primary"
              name="home"
              outline
            />
          </Link>
        </PageHeader>

        <div class="w-full mt-8">
            <div v-if="$page.props.jetstream.canUpdateProfileInformation">
                <UpdateProfileInformationForm
                    :user="$page.props.user"
                />
                <SectionBorder />
            </div>
            <div v-if="$page.props.jetstream.canUpdatePassword">
                <UpdatePasswordForm
                    class="mt-10 sm:mt-0"
                />
                <SectionBorder />
            </div>
            <div v-if="$page.props.jetstream.canManageTwoFactorAuthentication">
                <TwoFactorAuthenticationForm 
                    :requires-confirmation="confirmsTwoFactorAuthentication"
                    class="mt-10 sm:mt-0" 
                />
                <SectionBorder />
            </div>
            <LogoutOtherBrowserSessionsForm
                class="mt-10 sm:mt-0"
                :sessions="sessions"
            />
            <template v-if="$page.props.jetstream.hasAccountDeletionFeatures">
                <SectionBorder />
                <DeleteUserForm
                    class="mt-10 sm:mt-0"
                />
            </template>
        </div>
    </DashboardLayout>
</template>
