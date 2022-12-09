// Notifica los Inicios de session de los demás usuarios
Echo.channel('notifications')
  .listen('UserSessionChanged', (e) => {
    Notify.info(e.message);
});