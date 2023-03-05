a<script setup>
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { hasPermission } from '@/rolePermission.js';

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
            <Link
                v-if="hasPermission('users.create')"
                :href="route('admin.users.create')"
            >
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
                            v-text="$t('contact')"
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
                                {{user.full_name}}
                              </p>
                            </div>
                          </div>
                        </td>
                        <td class="table-item border">
                          <div class="flex items-center text-sm">
                            <div>
                              <p class="font-semibold text-black">
                                <a 
                                    :href="`mailto:${user.email}`"
                                    class="hover:text-primary"
                                    target="_blank"
                                >
                                    {{user.email}}
                                </a>
                              </p>
                              <p v-if="user.phone" class="font-semibold text-xs text-gray-600">
                                <b>Teléfono: </b>
                                <a 
                                    :href="`tel:${user.phone}`"
                                    class="hover:text-primary"
                                    target="_blank"
                                >
                                    {{user.phone}}
                                </a>
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
                                <GoogleIcon
                                    v-if="hasPermission('users.edit')"
                                    class="btn-icon-primary"
                                    name="edit"
                                    outline
                                    @click="edit(user)"
                                />
                                <GoogleIcon
                                    v-if="hasPermission('users.destroy')"
                                    class="btn-icon-primary"
                                    name="delete"
                                    outline
                                    @click="destroy(user)"
                                />
                                <Link
                                    v-if="hasPermission('users.config')"
                                    :href="route('admin.users.settings', user.id)"
                                >
                                    <GoogleIcon
                                        class="btn-icon-primary"
                                        name="settings"
                                    />
                                </Link>
                            </div>
                        </td>
                    </tr>
                </template>
            </Table>
        </div>
        <ShowView 
            v-if="hasPermission('users.index')"
            :show="showModal" 
            :user="user" 
            @switchModal="switchModal"
            @close="switchShowModal"
        />

        <EditView
            v-if="hasPermission('users.edit')"
            :show="editModal"
            :user="user"
            @switchModal="switchModal"
            @close="switchEditModal"
        />
        <DestroyView
            v-if="hasPermission('users.destroy')"
            :show="destroyModal"
            :user="user"
            @close="switchDestroyModal"
        />
    </DashboardLayout>
</template>
    