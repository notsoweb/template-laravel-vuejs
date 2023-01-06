<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { hasRole } from '@/rolePermission.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import DestroyView from './Destroy.vue';
import EditView from './Edit.vue';
import GoogleIcon from '@/Components/Dashboard/GoogleIcon.vue';
import PageHeader from '@/Components/Dashboard/PageHeader.vue';
import Table from '@/Components/Dashboard/Table.vue';

const props = defineProps({
    roles: Object
});

let editModal = ref(false);
let destroyModal = ref(false);
let role = ref(null);

const edit = (detail) => {
    role.value = detail;
    switchEditModal();
}

const destroy = (detail) => {
    role.value = detail;
    switchDestroyModal();
}

const switchEditModal = () => editModal.value = !editModal.value;
const switchDestroyModal = () => destroyModal.value = !destroyModal.value;
</script>  
<template>
    <AppLayout :title="$t('roles.title')">
        <PageHeader>
            <Link :href="route('dashboard')">
                <GoogleIcon
                    class="btn-icon-primary"
                    name="home"
                    outline
                />
            </Link>
            <Link :href="route('roles.create')">
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
                                    class="btn-icon-primary"
                                    name="edit"
                                    outline
                                    @click="edit(role)"
                                />
                                <template v-if="hasRole('developer')">
                                    <GoogleIcon
                                        class="btn-icon-primary"
                                        name="delete"
                                        outline
                                        @click="destroy(role)"
                                    />
                                </template>
                            </div>
                        </td>
                    </tr>
                </template>
            </Table>
        </div>
        <template v-if="hasRole('developer')">
        <EditView
            :role="role"
            :show="editModal"
            @close="switchEditModal"
        />
        <DestroyView
            :role="role"
            :show="destroyModal"
            @close="switchDestroyModal"
        />
        </template>
    </AppLayout>
</template>
    