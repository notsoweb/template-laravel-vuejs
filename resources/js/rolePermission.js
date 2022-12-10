import { router } from '@inertiajs/vue3';

/**
 * Permite consultar si un usuario tiene un role
 */
const hasRole = (roles) => {
    let userRoles = router.page.props.shareUserRoles;
    let verifyRoles = roles.split('|'); 

    for (let role in verifyRoles) {
        if(userRoles.length != 0) {
            if(userRoles.indexOf(verifyRoles[role]) != -1) {
                return true;
            }
        }
    }

    return false;
}

/**
 * Permite consultar si un usuario tiene un permiso especifico
 */
const hasPermission = (permisions) => {
    let userPermissions = router.page.props.shareUserPermissions;
    let verifyPermissions = permisions.split('|');

    for (let permision in verifyPermissions) {
        if(userPermissions.length != 0) {
            if(userPermissions.indexOf(permision) != -1) {
                return true;
            }
        }
    }

    return false;
}

export {hasRole, hasPermission};