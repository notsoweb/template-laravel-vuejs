import toastr from 'toastr';
import { Inertia } from '@inertiajs/inertia';

class Notify {
  constructor() {}

  flash(title = 'Successful registration', type = 'success') {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr[type](title);
  }

  success(title) {
    this.flash(title);
  }

  error(title) {
    this.flash(title, 'error');
  }
  
  info(title) {
    this.flash(title, 'info');
  }

  warning(title) {
    this.flash(title, 'warning');
  }

  verifyLaravelNotifyFlash() {
    if(Inertia.page.props.flash) {
        Inertia.page.props.flash.forEach(element => {
            Notify.flash(element.message, element.type);
        });
    }
  
    if (Inertia.page.props.jetstream.flash.length != 0) {
        Inertia.page.props.jetstream.flash.forEach(element => {
            Notify.flash(element.message, element.type);
        });
    }
  }

}

export default Notify;
