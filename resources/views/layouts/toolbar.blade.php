<v-toolbar app>

    <v-toolbar-title>

        @if( Auth::check() && Route::currentRouteName() != 'home' )

            <v-toolbar-side-icon @click.stop=" toggleLeftDrawer "></v-toolbar-side-icon>
        @endif

        {{ config( 'app.name' ) }}

    </v-toolbar-title>

    <v-spacer></v-spacer>

    <social-media tooltip="bottom" style="flex: 0 1 auto"></social-media>

    @if( Route::has( 'login' ) && !Auth::check() )

        <login-button action="{{ $action ?? null }}"></login-button>
        <register-button action="{{ $action ?? null }}"></register-button>
        <remember-password action="{{ $action ?? null }}"></remember-password>
        <reset-password
            action="{{ $action ?? null }}"
            token="{{ $token ?? null }}"
            email="{{ $email ?? null }}">
        </reset-password>
    @endif

    @auth

        <v-btn icon large @click=" toggleLeftDrawer ">

            <gravatar :user="{{ Auth::user() }}" size="35px"></gravatar>
        </v-btn>
    @endauth
</v-toolbar>