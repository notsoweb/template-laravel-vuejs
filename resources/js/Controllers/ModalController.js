import { ref } from 'vue';

/**
 * Controlador simple de las bandejas
 */
class ModalController
{
    noteModal = ref(false);
    manyNotesModal = ref(false);
    showModal = ref(false);
    editModal = ref(false);
    destroyModal = ref(false);
    modelModal = ref({});
    
    constructor() {}

    /**
     * Controla el cambio entre show y edit
     */
    switchShowEditModal = () => {
        this.showModal.value = !this.showModal.value
        this.editModal.value = !this.editModal.value
    };

    /**
     * Controla el switch de eliminar
     */
    switchShowModal = (model) => {
        this._setModel(model);
        this.showModal.value = !this.showModal.value
    };

    /**
     * Controla el switch de eliminar
     */
    switchEditModal = (model) => {
        this._setModel(model);
        this.editModal.value = !this.editModal.value
    };

    /**
     * Controla el switch de eliminar
     */
    switchDestroyModal = (model) => {
        this._setModel(model);
        this.destroyModal.value = !this.destroyModal.value
    };

    /**
     * Controla el switch de eliminar
     */
    switchNoteModal = () => {
        this.noteModal.value = !this.noteModal.value
    };

    /**
     * Controla el switch de eliminar
     */
    switchManyNotesModal = () => {
        this.manyNotesModal.value = !this.manyNotesModal.value
    };


    /**
     * Guarda el modelo
     */
    _setModel = (model) => {
        if(model) {
            console.log('Modelo guardado');
            this.modelModal.value = model;
        }
    }
}

export default ModalController;