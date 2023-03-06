<script setup>
import { reactive } from 'vue';
import { Link } from '@inertiajs/vue3';
import { hasPermission } from '@/rolePermission.js';
import ModalController from '@/Controllers/ModalController.js';

import PageHeader      from '@/Components/Dashboard/PageHeader.vue';
import Table           from '@/Components/Dashboard/Table.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DestroyView     from './Destroy.vue';
import EditView        from './Edit.vue';

const props = defineProps({
    roles: Object
});

// Controladores
const Modal = new ModalController();

// Variables de controladores
const destroyModal = reactive(Modal.destroyModal);
const editModal    = reactive(Modal.editModal);
const modelModal   = reactive(Modal.modelModal);
</script>

<template>
    <DashboardLayout :title="$t('roles.title')">
        <PageHeader>
            <Link :href="route('dashboard.index')">
                <GoogleIcon
                    class="btn-icon-primary"
                    name="home"
                    outline
                />
            </Link>
            <Link
                v-if="hasPermission('roles.create')"
                :href="route('developer.roles.create')"
            >
                <GoogleIcon
                    class="btn-icon-primary"
                    name="add"
                    outline
                />
            </Link>
        </PageHeader>
        <div class="pt-2 w-full">
            <Table :links="roles.links">
                <template #head>
                    <tr class="table-head">
                        <th
                            class="table-item"
                            v-text="$t('role')"
                        />
                        <th
                            class="table-item"
                            v-text="$t('description')"
                        />
                        <th
                            class="table-item"
                            v-text="$t('actions')"
                        />
                    </tr>
                </template>
                <template #body>
                    <tr v-for="role in roles.data" class="text-gray-700">
                        <td class="table-item border">
                          <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    {{role.name}}
                                </p>
                            </div>
                          </div>
                        </td>
                        <td class="table-item border">
                          <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    {{role.description}}
                                </p>
                            </div>
                          </div>
                        </td>
                        <td class="table-item border">
                            <div class="flex justify-center space-x-2">
                                <GoogleIcon
                                    v-if="hasPermission('roles.edit')"
                                    class="btn-icon-primary"
                                    name="edit"
                                    outline
                                    @click="Modal.switchEditModal(role)"
                                />
                                <GoogleIcon
                                    v-if="hasPermission('roles.destroy')"
                                    class="btn-icon-primary"
                                    name="delete"
                                    outline
                                    @click="Modal.switchDestroyModal(role)"
                                />
                            </div>
                        </td>
                    </tr>
                </template>
            </Table>
        </div>
        <EditView
            v-if="hasPermission('roles.edit')"
            :role="modelModal"
            :show="editModal"
            @close="Modal.switchEditModal"
        />
        <DestroyView
            v-if="hasPermission('roles.destroy')"
            :role="modelModal"
            :show="destroyModal"
            @close="Modal.switchDestroyModal"
        />
    </DashboardLayout>
</template>
    