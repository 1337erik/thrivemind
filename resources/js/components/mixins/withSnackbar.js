import { mapGetters } from 'vuex';

export default {

    computed: {

        ...mapGetters({

            snackbarTimeout : 'snackbar/snackbarTimeout'
        })
    },
    methods: {

        showMessage( msg ){

            this.showSnackBar( msg, 'success' );
        },
        showError( err ){

            this.showSnackBar( err, 'error' );
        },
        cleanState(){

            setTimeout( () => {

                this.$store.commit( 'snackbar/set_snackbar_show', false );
            }, this.snackbarTimeout );
        },
        showSnackBar( msg, color ){

            this.$store.commit( 'snackbar/set_snackbar_show', true );
            this.$store.commit( 'snackbar/set_snackbar_color', color );
            if( typeof msg === 'string' ){

                this.$store.commit( 'snackbar/set_snackbar_text', msg );
                this.cleanState();
                return;
            }

            this.$store.commit( 'snackbar/set_snackbar_text', msg.message );

            if( msg.response ) this.$store.commit( 'snackbar/set_snackbar_subtext', msg.response.data.message );
            this.cleanState();
        }
    }
}