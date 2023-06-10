<script setup>
import { can, goTo, transl } from './Component';
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import ModalController from '@/Controllers/ModalController.js';

import PageHeader      from '@/Components/Dashboard/PageHeader.vue';
import Table           from '@/Components/Dashboard/Table.vue';
import GoogleIcon      from '@/Components/Shared/GoogleIcon.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DestroyView     from './Destroy.vue';
import EditView        from './Edit.vue';

defineProps({
    roles: Object
});

// Controladores
const Modal = new ModalController();

// Variables de controladores
const destroyModal = ref(Modal.destroyModal);
const editModal    = ref(Modal.editModal);
const modelModal   = ref(Modal.modelModal);
</script>

<template>
    <DashboardLayout :title="transl('title')">
        <PageHeader>
            <Link :href="route('dashboard.index')">
                <GoogleIcon
                    class="btn-icon-primary"
                    name="home"
                    outline
                />
            </Link>
            <Link
                v-if="can('create')"
                :href="route(goTo('create'))"
            >
                <GoogleIcon
                    class="btn-icon-primary"
                    name="add"
                    outline
                />
            </Link>
        </PageHeader>
        <div class="pt-2 w-full">
            <Table :items="roles">
                <template #head>
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
                </template>
                <template #body="{items}">
                    <tr v-for="model in items" class="text-gray-700">
                        <td class="table-item border">
                          <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    {{ model.name }}
                                </p>
                            </div>
                          </div>
                        </td>
                        <td class="table-item border">
                          <div class="flex items-center text-sm">
                            <div>
                                <p class="font-semibold text-black">
                                    {{ model.description }}
                                </p>
                            </div>
                          </div>
                        </td>
                        <td class="table-item border">
                            <div class="flex justify-center space-x-2">
                                <GoogleIcon
                                    v-if="can('edit')"
                                    class="btn-icon-primary"
                                    name="edit"
                                    outline
                                    @click="Modal.switchEditModal(model)"
                                />
                                <GoogleIcon
                                    v-if="can('destroy')"
                                    class="btn-icon-primary"
                                    name="delete"
                                    outline
                                    @click="Modal.switchDestroyModal(model)"
                                />
                            </div>
                        </td>
                    </tr>
                </template>
            </Table>
        </div>
        <EditView
            v-if="can('edit')"
            :model="modelModal"
            :show="editModal"
            @close="Modal.switchEditModal"
        />
        <DestroyView
            v-if="can('destroy')"
            :model="modelModal"
            :show="destroyModal"
            @close="Modal.switchDestroyModal"
        />
    </DashboardLayout>
</template>
    