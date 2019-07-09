import sampleModule from './modules/sample';
import navigation from './modules/navigation';
import users from './modules/users';
import snackbar from './modules/snackbar';
import auth from './modules/auth';
import todo from './modules/todo';

export const store = {

    state : {

    },
    mutations: {

    },
    actions : {

    },
    getters : {

    },
    modules : {

        s   : sampleModule,
        nav : navigation, // example of a module alias
        auth,
        users,
        snackbar,
        todo
    }
}