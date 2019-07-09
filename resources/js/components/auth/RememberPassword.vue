<template>

    <v-dialog v-model=" showRememberPassword " persistent max-width="500px">

        <v-card>

            <v-card-title>

                <span class="headline">Send reset password email</span>
            </v-card-title>
            <v-card-text>

                <v-form ref="resetPasswordForm" v-model=" valid ">

                    <v-text-field
                            label="E-mail"
                            v-model=" email "
                            :rules=" emailRules "
                            :error=" errors[ 'email'] "
                            :error-messages=" errors[ 'email' ] "
                            required
                    ></v-text-field>
                </v-form>
                <a href="/login" color="blue darken-2">
                    Login
                </a> &nbsp; |
                <a href="/register" color="blue darken-2">
                    Register
                </a>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click.native=" showRememberPassword = false ">Close</v-btn>
                <v-btn
                    :loading=" loading "
                    flat
                    :color=" done ? 'green' : 'blue' "
                    @click.native=" rememberPassword "
                >
                    <v-icon v-if=" !done ">mail_outline</v-icon>
                    <v-icon v-else>done</v-icon>
                    &nbsp;
                    <template v-if=" !done ">Send</template>
                    <template v-else>Done</template>
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>


<script>

  import sleep from '../../utils/sleep';
  import withSnackbar from '../mixins/withSnackbar';

  export default {

    mixins: [ withSnackbar ],
    data () {

      return {

        valid           : false,
        internalAction  : this.action,
        loading         : false,
        done            : false,
        errorMessage    : '',
        errors          : [],
        email           : '',
        emailRules      : [

          ( v ) => !!v || 'Email is required',
          ( v ) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( v ) || 'Must be a valid email address'
        ]
      }
    },
    props: {

      action: {

        type: String,
        default: null
      }
    },
    methods: {

      rememberPassword () {

        if ( this.$refs.resetPasswordForm.validate() ) {

            this.loading = true
            this.$store.dispatch( 'auth/remember_password', this.email )
            .then( res => {

                this.loading = false;
                this.done = true;
                sleep( 4000 ).then(() => { this.showRememberPassword = false })
            }).catch( err => {

                if ( err.response && err.response.status === 422 ) {

                    this.showError({

                        message: 'Invalid data'
                    })
                } else {

                    this.showError( err )
                }
            }).then( () => {

                this.loading = false
            });
        }
      }
    },
    computed: {

      showRememberPassword: {

        get () {

          if ( this.internalAction && this.internalAction === 'request_new_password' ) return true
          return false
        },
        set ( value ) {

          if ( value ) this.internalAction = 'request_new_password'
          else this.internalAction = null
        }
      }
    }
  }
</script>