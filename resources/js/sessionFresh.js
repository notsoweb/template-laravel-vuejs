// Guarda los datos de la sessión mientras no se recarge la pagina
class SessionFresh {
    layout = false;
    header = false;
    userId = null;

    constructor() {}

    isLayoutInitialized() {
        return this.init;
    }

    isHeaderInitialized() {
        return this.header;
    }

    startLayout() {
        this.init = true;
    }

    startHeader() {
        this.header = true;
    }

    startUser(user) {
        this.userId = user;
    }

    stop() {
        this.layout = false;
        this.header = false;
        this.userId = null;
    }
}

export { SessionFresh }