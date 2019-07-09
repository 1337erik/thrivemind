<template>

    <v-snackbar
        :timeout=" snackbarTimeout "
        :color=" snackbarColor "
        v-model=" snackbarShow "
        :multi-line=" true "
    >

        {{ snackbarText }}
        <br />
        {{ snackbarSubtext }}
        <v-btn dark flat @click.native=" close ">Close</v-btn>
    </v-snackbar>
</template>

<script>

    import { mapGetters } from 'vuex';

    export default {

        computed: {

            ...mapGetters({

                snackbarShow    : 'snackbar/snackbarShow',
                snackbarColor   : 'snackbar/snackbarColor',
                snackbarText    : 'snackbar/snackbarText',
                snackbarSubtext : 'snackbar/snackbarSubtext',
                snackbarTimeout : 'snackbar/snackbarTimeout'
            })
        },
        methods: {

            close(){

                this.$store.commit( 'snackbar/set_snackbar_show', false );
            }
        }
    }
</script>

<style>

</style>
