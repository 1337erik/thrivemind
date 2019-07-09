@extends( 'layouts.app' )

@section( 'content' )

    @include( 'app.leftDrawer' )

    <v-content>

        <v-container grid-list-md>

            <router-view></router-view>
        </v-container>
    </v-content>
@endsection