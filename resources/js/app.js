let userHeader = document.head.querySelector( 'meta[name="user"]' );
window.user    = null;
if ( userHeader ) {

    if ( userHeader.content ) {

        window.user = JSON.parse( userHeader.content );
    }
}

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

const files = require.context( './', true, /\.vue$/i );
files.keys().map( key => Vue.component( key.split( '/' ).pop().split( '.' )[ 0 ], files( key ).default ) );

// Vue.component( 'example-component', require( './components/ExampleComponent.vue' ).default );


import Vue from 'vue';

import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector( 'meta[name="csrf-token"]' );
if ( token ) window.axios.defaults.headers.common[ 'X-CSRF-TOKEN' ] = token.content;
else console.error( 'CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token' );

import VueRouter from 'vue-router';
import routes from './router/router';
Vue.use( VueRouter );


import Vuex from 'vuex';
import { store } from './vuex/index';
Vue.use( Vuex );

import colors from 'vuetify/es5/util/colors';
import 'material-design-icons-iconfont/dist/material-design-icons.css';
import '@fortawesome/fontawesome-free/css/all.css';

import Vuetify from 'vuetify';
Vue.use( Vuetify, {

    theme : { // just going to put this here for when i'm ready to theme

        ...colors,
        primary   : '#1976D2',
        secondary : '#424242',
        accent    : '#82B1FF',
        error     : '#FF5252',
        info      : '#2196F3',
        success   : '#4CAF50',
        warning   : '#FFC107'
    },
    iconfont: 'md', // 'md' || 'mdi' || 'fa' || 'fa4'
});


// should be based on environment
Vue.config.productionTip = false;


/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Echo = new Echo({

    broadcaster : 'pusher',
    key         : 'ce00d1a2986a5d113e68', // process.env.MIX_PUSHER_APP_KEY,
    cluster     : 'us2', // process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted   : true
});


import withSnackbar from './components/mixins/withSnackbar';
import { mapGetters, mapActions } from 'vuex';

let app = new Vue({

    el: '#app',

    store : new Vuex.Store( store ),
    router: new VueRouter( routes ),

    mixins: [ withSnackbar ],

    props: {

    },
    data: () => ({

        drawerLeft       : true,

        logoutLoading    : false,
        editingUser      : false,
        updatingUser     : false,
        changingPassword : false,
        routes           : routes.routes
    }),
    methods: {

        toggleLeftDrawer() {

            this.drawerLeft = !this.drawerLeft;
        },
        updateEmail( email ){

            this.$store.commit( 'auth/user', { ...this.user, email });
        },
        updateName( name ){

            this.$store.commit( 'auth/user', { ...this.user, name });
        },
        updateUser(){

            this.updatingUser = true;
            this.$store.dispatch( 'users/update_user', this.user )
            .then( res => {

                this.showMessage( 'User modified ok!' );
            })
            .catch( err => {

                console.dir( err );
                this.showError( err );
            })
        },
        editUser(){

            this.editingUser = true;
            this.$nextTick( this.$refs.email.focus );
        },
        logout(){

            this.logoutLoading = true;
            this.$store.dispatch( 'auth/logout' )
            .then( res => {

                window.location = '/home';
            })
            .catch( err => {

                console.log( err );
            })
            .then( () => {

                this.logoutLoading = false;
            })
        },
        changePassword () {

            this.changingPassword = true;
            this.$store.dispatch( 'auth/remember_password', this.user.email ).then( response => {

              this.showMessage( 'Email sent to change password' );
            }).catch( error => {

              console.dir( error );
              this.showError( error );
            }).then(() => {

              this.changingPassword = false;
            })
        }
    },
    computed: {

        ...mapGetters({

            user : 'auth/user'
        })
    },
    mounted(){

        this.$store.commit( 'auth/user', window.user );
    }
});