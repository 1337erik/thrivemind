<v-navigation-drawer
    v-model=" drawerLeft "
    fixed
    app
    left>

    <v-layout fill-height column>

        <v-flex shrink py-4>

            <v-layout column wrap align-center>

                <gravatar :user="{{ Auth::user() }}" size="100px"></gravatar>
                <v-flex xs12 mt-2 style="text-align:center">

                    <h3>@{{ user ? user.name : '' }}</h3>
                    <a href="https://en.gravatar.com/connect/">Change Avatar</a>
                </v-flex>
            </v-layout>
        </v-flex>

        <v-divider></v-divider>

        <v-flex grow>

            <v-list dense >

                <v-list-tile href="/home">

                    <v-list-tile-action>

                        <v-icon>home</v-icon>
                    </v-list-tile-action>
                    <v-list-tile-content>

                        <v-list-tile-title>Home</v-list-tile-title>
                    </v-list-tile-content>
                </v-list-tile>
                <template @click="" v-for=" ( route, i ) in routes ">

                    <v-list-tile v-if=" route.onNavDrawer " :key=" i " :to=" route.path ">

                        <v-list-tile-action>

                            <v-icon>@{{ route.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>

                            <v-list-tile-title>@{{ route.name }}</v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
        </v-flex>

        <v-card-text class="px-0 grey lighten-3">

            <v-form class="pl-3 pr-1 ma-0">

                <v-text-field :readonly=" !editingUser "
                    label="Email"
                    :value=" user ? user.email : '' "
                    ref="email"
                    @input=" updateEmail "
                ></v-text-field>
                <v-text-field :readonly=" !editingUser "
                    label="User name"
                    :value=" user ? user.name : '' "
                    @input=" updateName "
                ></v-text-field>
            </v-form>
        </v-card-text>

        <v-card-actions>

            <v-btn :loading="updatingUser" flat color="green" @click="updateUser" v-if="editingUser">

                <v-icon right dark>save</v-icon>
                Save
            </v-btn>
            <v-btn flat color="orange" @click="editUser()" v-else>

                <v-icon right dark>edit</v-icon>
                Edit
            </v-btn>
            <v-btn :loading="logoutLoading" @click="logout" flat color="orange">

                <v-icon right dark>exit_to_app</v-icon>
                Logout
            </v-btn>
        </v-card-actions>

        <v-card-actions>

            <v-spacer></v-spacer>
            <v-btn :loading="changingPassword" flat color="red" @click="changePassword">Change Password</v-btn>
            <v-spacer></v-spacer>
        </v-card-actions>
    </v-layout>
</v-navigation-drawer>