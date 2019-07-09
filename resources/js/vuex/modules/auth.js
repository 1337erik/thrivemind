
export default {

    namespaced : true,
    state: {

        token  : null,
        user   : window.user || null,
        logged : false
    },
    mutations: {

        logged( state, logged ){

            state.logged = logged;
        },
        user( state, user ){

            state.user = user;
        }
    },
    actions: {

        login( context, credentials ){

            return new Promise( ( resolve, reject ) => {

                axios.post( '/login', credentials )
                .then( res => {

                    context.commit( 'logged', true );
                    resolve( res );
                })
                .catch( err => {

                    reject( err );
                });
            })
        },
        logout( context ){

            return new Promise( ( resolve, reject ) => {

                axios.post( '/logout' )
                .then( res => {

                    context.commit( 'logged', false );
                    resolve( res );
                })
                .catch( err => {

                    reject( err );
                })
            })
        },
        register( context, user ){

            return new Promise( ( resolve, reject ) => {

                axios.post( '/register', {

                    'name'                  : user.name,
                    'email'                 : user.email,
                    'password'              : user.password,
                    'password_confirmation' : user.password_confirmation
                })
                .then( res => {

                    context.commit( 'logged', false );
                    resolve( res );
                })
                .catch( err => {

                    reject( err );
                });
            });
        },
        remember_password( context, email ){

            return new Promise( ( resolve, reject ) => {

                axios.post( '/password/email', {

                    'email' : email
                })
                .then( res => {

                    resolve( res );
                })
                .catch( err => {

                    reject( err );
                })
            })
        },
        reset_password( context, user ){

            return new Promise( ( resolve, reject ) => {

                axios.post( '/password/reset', {

                    'email'                 : user.email,
                    'password'              : user.password,
                    'password_confirmation' : user.password_confirmation,
                    'token'                 : user.token
                })
                .then( res => {

                    resolve( res );
                })
                .catch( err => {

                    reject( err );
                })
            });
        }
    },
    getters: {

        logged : state => state.logged,
        token  : state => state.token,
        user   : state => state.user,
        roles  : state => state.user ? state.user.roles : []
    }
}