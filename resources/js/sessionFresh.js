import { ref } from "vue";
import { router } from '@inertiajs/vue3';
import useFetch from '@/useFetch.js';

/**
 * Debido a la propia naturaleza reactiva de vuejs, hay datos que solo existen mientras se
 * este en un componente o pagina.
 * 
 * Este elemento permite mantener datos en todas las paginas siempre y cuando no se recargue la pagina.
 */
class SessionFresh {
    layout = false;
    header = false;
    userId = null;
    notifications = ref([]);
    notificationCounter = ref(0);

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

    // Actualiza las notificaciones del usuario
    updateNotifications() {
        useFetch(route('dashboard.users.notifications'))
        .then((res) => {
          let unread = 0;
            res.notifications.forEach(element => {
              if(element.read_at == null) {
                unread++;
              }
            });

            this.notificationCounter.value = unread;
            this.notifications.value = res.notifications;
        }).catch((err) => {
            Notify.error(err.message);
        });
    }

    showNotification(id) {
        if(this.notificationCounter.value > 0) {
            this.notificationCounter.value--;
        }
        
        router.post(route('dashboard.notifications.store'), {
            id:id
        });
    }

    getNotificationCounter() {
        return this.notificationCounter;
    }

    getNotifications() {
        return this.notifications;
    }
}

export { SessionFresh }