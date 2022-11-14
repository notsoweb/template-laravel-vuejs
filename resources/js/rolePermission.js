import { Inertia } from '@inertiajs/inertia';

/**
 * Permite consultar si un usuario tiene un role
 */
const hasRole = (role) => {
    let roles = Inertia.page.props.roles;

    if(roles.length != 0) {
        if(roles.indexOf(role) != -1) {
            return true;
        }
    }

    return false;
}

/**
 * Permite consultar si un usuario tiene un role
 */
 const hasPermission = (permision) => {
    let roles = Inertia.page.props.permissions;

    if(roles.length != 0) {
        if(roles.indexOf(permision) != -1) {
            return true;
        }
    }

    return false;
}

export {hasRole, hasPermission};