export default {
    '&':'y',
    account: {
        delete: {
            confirm:'¿Está seguro de que quiere eliminar su cuenta? Una vez eliminada su cuenta, todos sus recursos y datos se borrarán permanentemente. Por favor, introduzca su contraseña para confirmar que desea eliminar permanentemente su cuenta.',
            description:'Eliminar permanentemente su cuenta.',
            onDelete:'Una vez eliminada su cuenta, todos sus recursos y datos se borrarán permanentemente. Antes de eliminar su cuenta, descargue los datos o la información que desee conservar.',
            title:'Eliminar cuenta',
        },
        email: {
            notifySendVerification:'Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.',
            sendVerification:'Haga clic aquí para volver a enviar el correo electrónico de verificación.',
            unverify: 'Su dirección de correo electrónico no está verificada.',
        },
        manage:'Administrar cuenta',
        password: {
            description:'Asegúrese de que su cuenta utiliza una contraseña larga y aleatoria para estar seguro.',
            new:'Nueva contraseña',
            reset:'Restaurar contraseña',
            update: 'Actualizar contraseña',
            verify:'Por su seguridad, confirme su contraseña para continuar.',
        },
        profile: {
            description:'Actualice la información del perfil de su cuenta y su dirección de correo electrónico.',
            title:'Información del perfil',
        },
        sessions: {
            confirm:'Por favor, introduzca su contraseña para confirmar que desea salir de sus otras sesiones de navegación en todos sus dispositivos.',
            description: 'Gestiona y cierra tus sesiones activas en otros navegadores y dispositivos.',
            last:'Último activo',
            logout:'Cerrar otras sesiones del navegador',
            onLogout:'Si es necesario, puede cerrar la sesión de todos sus otros navegadores en todos sus dispositivos. A continuación se enumeran algunas de sus sesiones recientes; sin embargo, esta lista puede no ser exhaustiva. Si crees que tu cuenta ha sido comprometida, también deberías actualizar tu contraseña.',
            this: 'Dispositivo actual',
            title: 'Sesiones del navegador',
        },
        twoFactor: {
            codes:{
                regenerate:'Regenerar los códigos de recuperación',
                show:'Mostrar códigos de recuperación',
                store:'Guarde estos códigos de recuperación en un gestor de contraseñas seguro. Pueden utilizarse para recuperar el acceso a su cuenta si se pierde su dispositivo de autenticación de dos factores.',
            },
            description:'Añada seguridad adicional a su cuenta mediante la autenticación de dos factores.',
            isEnable:'Ha activado la autenticación de dos factores.',
            isNotEnable:{
                title:'No ha activado la autenticación de dos factores.',
                description:'Cuando la autenticación de dos factores está activada, se le pedirá un token seguro y aleatorio durante la autenticación. Puedes recuperar este token desde la aplicación Google Authenticator de tu teléfono.',
            },
            key:'Llave de configuración',
            login: {
                onAuth: 'Por favor, confirme el acceso a su cuenta introduciendo el código de autentificación proporcionado por su aplicación de autentificación.',
                onRecovery: 'Confirme el acceso a su cuenta introduciendo uno de sus códigos de recuperación de emergencia.',
            },
            onFinish:'Termina de habilitar la autenticación de dos factores.',
            qr: {
                isConfirmed: 'La autenticación de dos factores ya está activada. Escanee el siguiente código QR con la aplicación de autenticación de su teléfono o introduzca la clave de configuración.',
                onConfirmed: 'Para terminar de habilitar la autenticación de dos factores, escanea el siguiente código QR utilizando la aplicación de autenticación de tu teléfono o introduce la clave de configuración y proporciona el código OTP generado.',
            },
            recovery: {
                code: 'Código de recuperación',
                useAuth: 'Utilizar un código de autentificación',
                useCode: 'Utiliza un código de recuperación',
            },
            title:'Autenticación de dos factores',
        },
    },
    actions:'Acciones',
    auth: {
        forgotPassword: {
            ask: '¿Olvidaste tu contraseña?',
            description: '¿Ha olvidado su contraseña? No hay problema. Sólo tienes que indicarnos tu dirección de correo electrónico y te enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.',
            sendLink: 'Enviar enlace de recuperación por correo',
            title: 'Contraseña olvidada',
        },
        login: 'Iniciar sesión',
        logout: 'Cerrar sesión',
        register: {
            already: '¿Ya estas registrado?',
            me: 'Registrarme',
        },
        remember: 'Recuerdame',
    },
    code:'Código',
    cancel:'Cancelar',
    changelogs: {
        title:'Historial de cambios',
        description: 'Lista de los cambios realizados al sistema.',
    },
    confirm:'Confirmar',
    copyright:'All rights reserved.',
    date: 'date',
    description:'Descripción',
    disable:'Deshabilitar',
    disabled:'Deshabilitado',
    done:'Hecho.',
    email:'Correo',
    enable:'Habilitar',
    endDate:'Fecha Fin',
    event:'Evento',
    help: {
        description:'A continuación se lista la iconografía para entender el funcionamiento del sistema.',
        home: 'Volver a la pagina de inicio.',
        title:'Ayuda',
    },
    history: {
        title:'Historial de acciones',
        description:'Historial de acciones realizadas por los usuarios en orden cronológico.'
    },
    home:'Inicio',
    icon:'Icono',
    maternal:'Apellido materno',
    name:'Nombre',
    noRecords:'Sin registros',
    notifications: {
        title:'Notificaciones',
    },
    password:'Contraseña',
    passwordConfirmation:'Confirmar contraseña',
    passwordCurrent:'Contraseña actual',
    paternal:'Apellido paterno',
    phone:'Teléfono',
    photo: {
        new: 'Seleccionar una nueva foto',
        remove:'Remover foto',
        title:'Foto',
    },
    profile:'Perfil',
    save:'Guardar',
    saved:'¡Guardado!',
    search:'Buscar',
    startDate:'Fecha de inicio',
    terms: {
        agree:'Estoy deacuerdo con los',
        privacy:'Política de privacidad',
        service:'Terminos de servicio',
    },
    unknown:'Desconocido',
    update:'Actualizar',
    updated:'Actualizado',
    user:'Usuario',
    users:{
        deleted:'Usuario eliminado',
        notFount:'Usuario no encontrado',
        password: {
            description:'Permite actualizar las contraseñas de los usuarios sobreescribiendola.',
            title:'Actualizar contraseña',
        },
        roles: {
            description:'Actualiza los roles de los usuarios, permitiendo o denegando los accesos a determinadas áreas.',
            error:{
                min:'Seleccionar minumo un role'
            },
            title:'Roles',
        },
        select:'Seleccionar usuario',
        settings:'Ajustes del usuario',
        system:'Usuarios del sistema',
        title:'Usuarios',
    },
    version:'Versión',
}