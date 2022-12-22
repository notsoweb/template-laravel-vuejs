export default {
    '&':'and',
    account: {
        delete: {
            confirm:'Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.',
            description: 'Permanently delete your account.',
            onDelete:'Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.',
            title:'Delete Account',
        },
        email: {
            notifySendVerification:'A new verification link has been sent to your email address.',
            sendVerification:'Click here to re-send the verification email',
            unverify: 'Your email address is unverified.',
        },
        manage:'Manage Account',
        password: {
            description:'Ensure your account is using a long, random password to stay secure.',
            new:'New password',
            reset:'Reset password',
            secure:'This is a secure area of the application. Please confirm your password before continuing.',
            update: 'Update Password',
            verify:'For your security, please confirm your password to continue.',
        },
        profile: {
            description:'Update your account\'s profile information and email address.',
            title:'Profile Information',
        },
        sessions: {
            confirm:'Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.',
            description: 'Manage and log out your active sessions on other browsers and devices.',
            last:'Last active',
            logout:'Log Out Other Browser Sessions',
            onLogout:'If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.',
            this: 'This device',
            title: 'Browser Sessions',
        },
        twoFactor: {
            codes:{
                regenerate:'Regenerate Recovery Codes',
                show:'Show Recovery Codes',
                store:'Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.',
            },
            description:'Add additional security to your account using two factor authentication.',
            isEnable:'You have enabled two factor authentication.',
            isNotEnable:{
                title:'You have not enabled two factor authentication.',
                description:'When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.',
            },
            key:'Setup Key',
            login: {
                onAuth: 'Please confirm access to your account by entering the authentication code provided by your authenticator application.',
                onRecovery: 'Please confirm access to your account by entering one of your emergency recovery codes.',
            },
            onFinish:'Finish enabling two factor authentication.',
            qr: {
                isConfirmed: 'Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.',
                onConfirmed: 'To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.',
            },
            recovery: {
                code: 'Recovery code',
                useAuth: 'Use an authentication code',
                useCode: 'Use a recovery code',
            },
            title:'Two Factor Authentication',
        },
    },
    actions:'Actions',
    auth: {
        forgotPassword: {
            ask: 'Forgot your password?',
            description: 'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.',
            sendLink: 'Email Password Reset Link',
            title: 'Forgot Password',
        },
        login: 'Log In',
        logout: 'Log Out',
        register: {
            already: 'Already registered?',
            me: 'Register me',
        },
        remember: 'Remember me',
    },
    code:'Code',
    cancel:'Cancel',
    changelogs: {
        title:'Changelogs',
        description: 'List of changes made to the system.',
    },
    confirm:'Confirm',
    copyright:'All rights reserved.',
    contact:'Contact',
    description:'Description',
    date:'Date',
    delete: {
        confirm:"By pressing DELETE the record will be permanently deleted and cannot be recovered.",
        title:'Deleted',
    },
    deleted:'Deleted',
    details:'Details',
    disable:'Disable',
    disabled:'Disable',
    done:'Done.',
    edit:'Edit',
    email:'Email',
    enable:'Enable',
    endDate:'End date',
    event:'Event',
    help: {
        description:'The following is a list of iconography to understand how the system works.',
        home: 'Back to home page.',
        title:'Help',
    },
    history: {
        title:'Stock history',
        description:'History of actions performed by users in chronological order.',
    },
    home:'Home',
    hour:'Hour',
    icon:'Icon',
    maternal:'Mother\'s last name',
    name:'Name',
    noRecords:'No records',
    notifications: {
        description:'User notifications',
        title:'Notifications',
    },
    password:'Password',
    passwordConfirmation:'Confirm Password',
    passwordCurrent:'Current Password',
    paternal:'Paternal surname',
    phone:'Phone Number',
    photo: {
        new: 'Select A New Photo',
        remove:'Remove Photo',
        title:'Photo',
    },
    profile:'Profile',
    readed:'Readed',
    role:'Role',
    roles:{
        create: {
            title: 'Create role',
            description: 'These roles will be used to give permissions in the system.',
            onSuccess: 'Role successfully created',
            onError: 'Error when creating the role',
        },
        deleted:'Role deleted',
        title: 'Roles',
    },
    save:'Save',
    saved:'Saved!',
    search:'Search',
    show: {
        all:'Show All',
        title:'Show',
    },
    startDate:'Start date',
    status:'Status',
    terms: {
        agree:'I agree to the',
        privacy:'Privacy Policy',
        service:'Terms of Service',
    },
    unknown:'Unknown',
    update:'Update',
    updated:'Updated',
    updateFail:'Error while updating',
    unreaded:'Unreaded',
    user:'User',
    users:{
        create:{
            title:'Create user',
            description:'Allows you to create new users. Don\'t forget to give them roles so that they can access the desired parts of the system.',
            onSuccess:'User created',
            onError:'An error occurred while creating the user',
        },
        deleted:'User deleted',
        notFount:'User not found',
        password: {
            description:'Allows users\' passwords to be updated',
            title:'Update password',
        },
        roles: {
            description:'Updates user roles, allowing or denying access to certain areas.',
            error:{
                min:'Select at least one role'
            },
            title:'Roles',
        },
        select:'Select a user',
        settings:'User setting',
        system:'System users',
        title:'Users',
    },
    version:'Version',
}