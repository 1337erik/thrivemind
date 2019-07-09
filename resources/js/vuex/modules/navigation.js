
export default {

    namespaced : true,
    state : {

        navOpen: false,
        right  : false
    },
    mutations: {

        toggleNav : state => state.navOpen = !state.navOpen
    },
    actions : {

        toggleNav( { state, commit } ){

            commit( 'toggleNav' );
        }
    },
    getters : {

        navOpen: state => state.navOpen,
        right  : state => state.right,
    }
}