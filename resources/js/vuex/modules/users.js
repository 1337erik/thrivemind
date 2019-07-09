export default {

    namespaced : true,
    state : {

        selected_user : {},
        users         : []
    },
    mutations: {

        selected_user( state, user ){

            state.selected_user = user;
        },
        set_users( state, users ){

            state.users = users;
        }
    },
    actions: {

        selected_user( context, user ){

            context.commit( 'selected_user', user );
        },
        fetch_users( context ){

            return new Promise( ( resolve, reject ) => {

                axios.get( '/api/v1/users' )
                .then( res => {

                    context.commit( 'set_users', res.data );
                    resolve( res );
                })
                .catch( err => {

                    reject( err );
                })
            })
        },
        update_user( context, user ){

            return new Promise( ( resolve, reject ) => {

                axios.put( '/api/v1/user', {

                    'name'  : user.name,
                    'email' : user.email
                })
                .then( res => {

                    console.log( 'update user response: ', res.data );
                    // context.commit( 'selected_user', user );
                    resolve( res );
                })
                .catch( err => {

                    reject( err );
                });
            })
        }

    },
    getters: {

        selectedUser : state => state.selected_user,
        users        : state => state.users
    }
};