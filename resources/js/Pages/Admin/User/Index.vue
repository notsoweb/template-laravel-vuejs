a<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { hasRole } from '@/rolePermission.js';

import Searcher        from '@/Components/Dashboard/Searcher.vue';
import Table           from '@/Components/Dashboard/Table.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DestroyView     from './Destroy.vue';
import EditView        from './Edit.vue';
import ShowView        from './Show.vue';

const props = defineProps({
    roles: Object,
    users: Object
});

let query = ref('');
let showModal = ref(false);
let editModal = ref(false);
let destroyModal = ref(false);
let user = ref({});

const search = (q = '') => {
    query.value = q;
    router.get(route('admin.users.index', {q}), {}, {preserveState: true});
};

const searchWithPagination = (page) =>  {
    let q = query.value;
    router.get(route('admin.users.index', {q, page}), {}, {preserveState: true});
}

const show = (detail) => {
    user.value = detail;
    switchShowModal();
}

const edit = (detail) => {
    user.value = detail;
    switchEditModal();
}

const destroy = (detail) => {
    user.value = detail;
    switchDestroyModal();
}

const switchModal = () => {
    switchEditModal();
    switchShowModal();
}

const switchShowModal = () => showModal.value = !showModal.value;
const switchEditModal = () => editModal.value = !editModal.value;
const switchDestroyModal = () => destroyModal.value = !destroyModal.value;
</script>  

<template>
    <DashboardLayout :title="$t('users.system')">
        <Searcher @search="search">
            <Link :href="route('dashboard.index')">
                <GoogleIcon
                    class="btn-icon-primary"
                    name="home"
                    outline
                />
            </Link>
            <Link :href="route('admin.users.create')">
                <GoogleIcon
                    class="btn-icon-primary"
                    name="add"
                    outline
                />
            </Link>
        </Searcher>
        <div class="pt-2 w-full">
            <Table :links="users.links" @send-pagination="searchWithPagination">
                <template #head>
                    <tr class="table-head">
                        <th
                            class="table-item"
                            v-text="$t('user')"
                        />
                        <th
                            class="table-item"
                            v-text="$t('actions')"
                        />
                    </tr>
                </template>
                <template #body>
                    <tr v-for="user in users.data" class="text-gray-700">
                        <td class="table-item border">
                          <div class="flex items-center text-sm">
                            <div>
                              <p class="font-semibold text-black">
                                {{user.name}} {{user.paternal}}  {{user.maternal}}
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="table-item border">
                            <div class="flex justify-center space-x-2">
                                <GoogleIcon
                                    class="btn-icon-primary"
                                    name="visibility"
                                    outline
                                    @click="show(user)"
                                />
                                <template v-if="hasRole('admin|developer')">
                                    <GoogleIcon
                                        class="btn-icon-primary"
                                        name="edit"
                                        outline
                                        @click="edit(user)"
                                    />
                                    <GoogleIcon
                                        class="btn-icon-primary"
                                        name="delete"
                                        outline
                                        @click="destroy(user)"
                                    />
                                    <Link :href="route('admin.users.settings', user.id)">
                                        <GoogleIcon
                                            class="btn-icon-primary"
                                            name="settings"
                                        />
                                    </Link>
                                </template>
                            </div>
                        </td>
                    </tr>
                </template>
            </Table>
        </div>
        <ShowView 
            :show="showModal" 
            :user="user" 
            @switchModal="switchModal"
            @close="switchShowModal"
        />

        <template v-if="hasRole('admin|developer')">
        <EditView
            :show="editModal"
            :user="user"
            @switchModal="switchModal"
            @close="switchEditModal"
        />
        <DestroyView
            :show="destroyModal"
            :user="user"
            @close="switchDestroyModal"
        />
        </template>
    </DashboardLayout>
</template>
    