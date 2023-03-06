import { ref } from 'vue';

/**
 * Controlador simple de las bandejas
 */
class InboxController
{
    inboxIdSelected = ref([]);
    inboxNumberSelected = ref([]);
    selectAll = ref(false);
    
    constructor() {}

    /**
     * Selecciona todas las opciones visibles
     */
    onSelectAll = (elements) => {
        this.inboxIdSelected.value = [];
        this.inboxNumberSelected.value = [];

        this.selectAll.value = !this.selectAll.value;
    
        if(this.selectAll.value) {
            elements.data.forEach(element => {
                this.inboxIdSelected.value.push(element.id);
                this.inboxNumberSelected.value.push(element.number);
            });
        }
    }

    /**
     * Selecciona solo una opcion
     */
    onSelectOne = (invoice) => {
        this.inboxIdSelected.value.push(invoice.id);
        this.inboxNumberSelected.value.push(invoice.number);
    }

    /**
     * Quita la seleccion
     */
    onUnselectOne = (invoice) => {
        this.inboxIdSelected.value = this.inboxIdSelected.value.filter(element => {
            return element !== invoice.id;
        });

        this.inboxNumberSelected.value = this.inboxNumberSelected.value.filter(element => {
            return element !== invoice.number;
        });
    }

    /**
     * Retorna todos los elementos seleccionados
     */
    getIdSelections = () => {
        return this.inboxIdSelected.value;
    }

    getNumberSelections = () => {
        return this.inboxNumberSelected.value;
    }
}

export default InboxController;