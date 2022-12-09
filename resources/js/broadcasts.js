// Notifica los Inicios de session de los demás usuarios
const AuthNotify = () => {
    console.log('Suscribiendose al canal notificaciones');
    Echo.private('notifications')
      .listen('UserSessionChanged', (e) => {
        console.log(e.message);
        Notify.info(e.message);
    });
}

const LeaveAuthNotify = () => {
    console.log('Dejando canal Notificaciones');
    Echo.leave('notifications');
}

const AuthNotifyUser = (userId) => {
    Echo.private('App.Models.User.' + userId)
    .notification((notification) => {
        console.log(notification);
    });
}

export {
    AuthNotifyUser,
    AuthNotify,
    LeaveAuthNotify
};