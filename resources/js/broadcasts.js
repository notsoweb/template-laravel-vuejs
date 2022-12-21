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

// Se suscribe a las notificaciones propias del usuario
const SuscribeUserNotification = (user, action) => {
    Echo.private('App.Models.User.' + user)
        .notification((notification) => {
            action(notification);
        });
}

// Detiene las notificaciones de inicio de session de los demás usuario
const UnsuscribeUserNotification = (user) => {
    Echo.leave('App.Models.User.' + user);
}

export {
    SuscribeUserAuth,
    UnsuscribeUserAuth,
    SuscribeUserNotification,
    UnsuscribeUserNotification
};