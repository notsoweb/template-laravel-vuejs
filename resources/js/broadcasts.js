// Notifica los Inicios de session de los demás usuarios
const SuscribeUserAuth = () => {
    Echo.private('notifications')
      .listen('UserSessionChanged', (e) => {
        Notify.info(e.message);
    });
}

// Detiene las notificaciones de inicio de session de los demás usuario
const UnsuscribeUserAuth = () => {
    Echo.leave('notifications');
}

export {
    SuscribeUserAuth,
    UnsuscribeUserAuth,
};