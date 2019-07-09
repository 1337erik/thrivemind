<template>

    <v-dialog v-model=" showResetPassword " persistent max-width="500px">

        <v-card>

            <v-card-title>

                <span class="headline">Reset Password</span>
            </v-card-title>
            <v-card-text>

                <v-form v-model=" valid " ref="resetPasswordForm">

                    <v-text-field
                        label="Email"
                        v-model=" internalEmail "
                        :rules=" emailRules "
                        required
                    ></v-text-field>
                    <v-text-field
                        name="password"
                        label="Password"
                        v-model=" password "
                        :rules=" passwordRules "
                        hint="At least 6 characters"
                        min="6"
                        type="password"
                        required
                    ></v-text-field>
                    <v-text-field
                        name="passwordConfirmation"
                        label="Password Confirmation"
                        v-model=" passwordConfirmation "
                        :rules=" passwordRules "
                        hint="At least 6 characters"
                        min="6"
                        type="password"
                        required
                    ></v-text-field>
                </v-form>
            </v-card-text>
            <v-card-actions>

                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" flat @click.native=" showResetPassword = false ">Close</v-btn>
                <v-btn
                    :loading=" loading "
                    flat
                    :color=" done ? 'green' : 'blue' "
                    @click.native=" reset "
                >
                    <v-icon v-if=" done ">done</v-icon>
                    &nbsp;
                    <template v-if=" !done ">Reset</template>
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
        data() {

            return {

                internalAction       : this.action,
                internalEmail        : this.email,
                loading              : false,
                done                 : false,
                emailRules           : [

                    ( v ) => !!v || 'Email is required',
                    ( v ) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test( v ) || 'Must be a valid email address'
                ],
                password             : '',
                passwordConfirmation : '',
                passwordRules        : [

                    ( v ) => !!v || 'Password is required',
                    ( v ) => v.length >= 6 || 'Password must be at least 6 characters'
                ],
                valid                : false
            }
        },
        props: {

            action : {

                type    : String,
                default : null
            },
            token  : {

                type    : String,
                default : null
            },
            email  : {

                type    : String,
                default : null
            }
        },
        computed: {

            showResetPassword: {

                get(){

                    return this.internalAction && ( this.internalAction === 'reset-password' )
                },
                set( value ) {

                    if( value ) this.internalAction = 'reset_password'
                    else this.internalAction = null
                }
            }
        },
        methods: {

            reset(){

                if( this.$refs.resetPasswordForm.validate() ){

                    const user = {

                        'email'                 : this.internalEmail,
                        'password'              : this.password,
                        'password_confirmation' : this.passwordConfirmation,
                        'token'                 : this.token
                    };

                    this.loading = true;

                    this.$store.dispatch( 'auth/reset_password', user )
                    .then( res => {

                        this.loading = false;
                        this.done = true;
                        sleep( 4000 ).then( () => {

                            this.showResetPassword = false;
                            window.location = '/home';
                        })
                    })
                    .catch( err => {

                        if( err.response && err.response.status === 422 ){

                            this.showError({

                                message: 'Invalid data'
                            });
                        } else {

                            this.showError( err );
                        }

                        this.errors = error.response.data.errors;
                    })
                    .then( () => {

                        this.loading = false;
                    });
                }
            }
        }
    }
</script>

<style>

</style>
