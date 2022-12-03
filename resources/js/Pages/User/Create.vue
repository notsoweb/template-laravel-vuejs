<script setup>
import { reactive, ref, watch } from 'vue';
import { Link, useForm } from '@inertiajs/inertia-vue3';
import {useFetch} from '@/useFetch.js';
import AppLayout from '@/Layouts/AppLayout.vue';
import CreateConvincedForm from './CreateForm.vue';
import Icon from '@/Components/App/Icon.vue';
import InputSearch from '@/Components/App/Form/Search.vue';
import PageHeader from '@/Components/App/PageHeader.vue';
import Select from '@/Components/App/Form/Select.vue';
import Input from '@/Components/App/Form/Input.vue';

let forms = useForm({entries:[]});
let colony = ref('');
let promoter = ref('');
let promotersList = ref([]);
let section = ref('');
let sectionReactive = reactive({section})

watch(promoter, (x) => {
    useFetch(route('promoters.getPromoterById', {promoter:x}))
        .then((res) => {
            colony.value = res.promoter.colony;
        }).catch((error) => {
            colony.value = '';
        });
});

const searchSections = (search) => {
    useFetch(route('promoters.bySection', {section:search}))
        .then((res) => {
            section.value = res.section_id;
            promotersList.value = res.promoters;
        }).catch((err) => {
            section.value = '';
            promotersList.value = [];
        });

    colony.value = '';
}

const store = () => {
    if (promoter.value != '') {
        // Sustituyo las datos de sección
        forms.entries.forEach(form => {
            form.promoter_id = promoter.value;
            form.section_id = section.value;
        });

        // Reformateo los datos para los errores.
        let newForm = {};

        forms.entries.forEach(form => {
            newForm[form.key] = form;
        });

        // Envio el formulario al servidor
        forms.transform(data => (newForm))
        .post(route('convinceds.store'),{
            preserveScroll: true,
            onSuccess: () => Notify.success('Convencido(s) registrado(s)'),
            onError: () => Notify.error('Verificar errores')
        });
    } else {
        Notify.error("Seleccione un promotor");
    }
}
</script>
<template>
    <AppLayout title="Crear convencidos">
        <PageHeader>
            <Link :href="route('convinceds.index')">
                <Icon class="btn-primary" name="keyboard_backspace" outline />
            </Link>
        </PageHeader>
        <div class="hidden">{{promoter}}</div>
        <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-3">
            <InputSearch
                id="search"
                title="Sección"
                required
                placeholder="# de sección"
                autocomplete="off"
                @search="searchSections"
            />
            <Select
                title="Promotor"
                id="committee_id"
                v-model="promoter"
                required
            >
                <template v-for="option in promotersList">
                    <option :value="option.id">
                        {{option.name}} {{option.paternal}} {{option.maternal}}
                    </option>
                </template>
            </Select>
            <Input
                id="colony"
                title="Localidad"
                v-model="colony"
                required
                disabled
            />
        </div>
        <CreateConvincedForm
            :forms="forms"
            :section="sectionReactive"
            @store="store"
        />
    </AppLayout>
</template>
