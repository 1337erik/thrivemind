@extends( 'layouts.app' )

@section('content')

    <v-content>

        <v-container fill-height>

            <v-layout align-center justify-center>

                <v-flex x12 sm6 md6>

                    <login-form
                        csrf="{{ csrf_token() }}"
                        errors="{{ $errors }}"
                    ></login-form>

                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
@endsection