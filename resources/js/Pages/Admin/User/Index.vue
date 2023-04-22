<script setup>
import { ref } from 'vue';
import { Link  } from '@inertiajs/vue3';
import { hasPermission } from '@/rolePermission.js';
import ModalController from '@/Controllers/ModalController.js';
import SearcherController from '@/Controllers/SearcherController.js';

import SearcherHead    from '@/Components/Dashboard/Searcher.vue';
import Table           from '@/Components/Dashboard/Table.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DestroyView     from './Destroy.vue';
import EditView        from './Edit.vue';
import ShowView        from './Show.vue';

const props = defineProps({
    users: Object
});

// Controladores
const Modal    = new ModalController();
const Searcher = new SearcherController('admin.users.index');

// Variables de controladores
const destroyModal = ref(Modal.destroyModal);
const editModal    = ref(Modal.editModal);
const showModal    = ref(Modal.showModal);
const modelModal   = ref(Modal.modelModal);
const query        = ref(Searcher.query);
</script>  

<template>
    <DashboardLayout :title="$t('users.system')">
        <SearcherHead @search="Searcher.search">
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
        </SearcherHead>
        <div class="pt-2 w-full">
            <Table :items="users" @send-pagination="Searcher.searchWithPagination">
                <template #head>
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
                </template>
                <template #body="{items}">
                    <tr v-for="user in items" class="text-gray-700">
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
                                    @click="Modal.switchShowModal(user)"
                                />
                                <GoogleIcon
                                    v-if="hasPermission('users.edit')"
                                    class="btn-icon-primary"
                                    name="edit"
                                    outline
                                    @click="Modal.switchEditModal(user)"
                                />
                                <GoogleIcon
                                    v-if="hasPermission('users.destroy')"
                                    class="btn-icon-primary"
                                    name="delete"
                                    outline
                                    @click="Modal.switchDestroyModal(user)"
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
            :user="modelModal" 
            @switchModal="Modal.switchShowEditModal"
            @close="Modal.switchShowModal"
        />

        <EditView
            v-if="hasPermission('users.edit')"
            :show="editModal"
            :user="modelModal"
            @switchModal="Modal.switchShowEditModal"
            @close="Modal.switchEditModal"
        />
        <DestroyView
            v-if="hasPermission('users.destroy')"
            :show="destroyModal"
            :user="modelModal"
            @close="Modal.switchDestroyModal"
        />
    </DashboardLayout>
</template>
    