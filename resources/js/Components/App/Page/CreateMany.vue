<script setup>
import { onMounted} from 'vue';
import Icon from '@/Components/App/Icon.vue';

const emit = defineEmits([
    'store'
]);

const props = defineProps({
    forms: Object,
    template: Object,
    registers: {
        type: Number,
        default: 3
    },
    title: {
        type: String,
        default: "Registro"
    }
});

let registers = 1;

const addForm = () => {
    props.forms.entries.push({...props.template, key: registers});
    registers++;
}

const deleteForm = (key, formKey) => {
    props.forms.entries.splice(key, 1);
    for (const [id, value] of Object.entries(props.forms.errors))
    {
        let error = id.split('.');
        
        if(error[0] == formKey){
            delete props.forms.errors[id];
        }
    }
    Notify.flash(`Formulario #${formKey} eliminado`);
}

const getFormError = (key, value) => {
    return  props.forms?.errors[`${key}.${value}`]
}

/**
 * Creamos la cantidad de formularios deseados
 */
onMounted(()=>{
    for(let i = 0; i < props.registers; i++) {
       addForm();
    }
});
</script>

<template>
    <form class="flex flex-col space-y-8 w-full pt-8" @submit.prevent="$emit('store')" autocomplete="off">
        <template v-for="(form, key) in forms.entries" :key="key">
            <div class="flex w-full justify-between border-b-2 border-gray-800">
                <div>
                    <h3>{{title}} #{{form.key}}</h3>
                </div>
                <div>
                    <button type="button" @click="deleteForm(key, form.key)">
                        <Icon class="btn-primary text-sm bg-red-500 hover:bg-red-700 hover:text-white" name="delete" outline />
                    </button>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-6 lg:grid-cols-12 border-gray-800 px-2 pb-4 shadow-lg">
                <slot :form="form" :key="form.key" :error="getFormError" />
            </div>
        </template>
        <div class="flex w-full justify-center space-x-4">
            <button class="w-fit px-4 py-2 bg-primary text-primary-text" type="submit">Guardar</button>
            <button @click="addForm" class="w-fit px-4 py-2 bg-primary text-primary-text" type="button">Agregar otro</button>
        </div>
    </form>
</template>