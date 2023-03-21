/**
 * Controla la conexion y sincronización de las notificaciones en tiempo
 * real dentro del sistema.
 * 
 * @author Moisés de Jesús Cortés Castellanos <ing.moisesdejesuscortesc@notsoweb>
 */

// Notifica los Inicios de session de los demás usuarios
const suscribeUserAuth = () => {
    console.log('Notificaciones globales');
    Echo.private('notifications')
        .listen('GlobalNotification', e => Notify.info(e.message));
}

// Detiene las notificaciones de inicio de session de los demás usuario
const unsuscribeUserAuth = () => Echo.leave('notifications');

/**
 * Inicia las suscripcion alas notificaciones del usuario y ejecuta la funcion pasada por el parametro action
 * @param {String} user Id del usuario
 * @param {Callback} action Callable de la accion a detonar una vez que se recibe la notificación
 */
const suscribeUserNotification = (user, action) => Echo.private(`App.Models.User.${user}`)
    .notification(notification => action(notification));

/**
 * Detiene las notificaciones especificas del usuario
 * 
 * @param {String} user Id del usuario
 * @returns 
 */
const unsuscribeUserNotification = user => Echo.leave(`App.Models.User.${user}`);

export {
    suscribeUserAuth,
    suscribeUserNotification,
    unsuscribeUserAuth,
    unsuscribeUserNotification
};