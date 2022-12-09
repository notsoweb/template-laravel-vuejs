// Guarda los datos de la sessión mientras no se recarge la pagina
class SessionFresh {
    init = false;

    constructor() {}

    isInitialized() {
        return this.init;
    }

    start() {
        this.init = true;
    }

    stop() {
        this.init = false;
    }
}

export { SessionFresh }