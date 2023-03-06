import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

/**
 * Controlador simple de las bandejas
 */
class SearcherController
{
    query = ref('');
    
    constructor(route, params) {
        this.route = route;
        this.params = params;
    }

    /**
     * Controla el cambio entre show y edit
     */
    search = (q = '') => {
        this.query.value = q;
        router.get(this._getRoute(), {
            q
        }, {preserveState: true});
    };

    /**
     * Controla el switch de eliminar
     */
    searchWithPagination = (page) =>  {
        router.get(this._getRoute(), {
            q: this.query.value,
            page
        }, {preserveState: true});
    }

    /**
     * Obtiene la ruta segun los parametros
     */
    _getRoute = () => {
        return (this.params)
            ? route(this.route, this.params)
            : route(this.route);
    }
}

export default SearcherController;