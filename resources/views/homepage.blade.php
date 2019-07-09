@extends( 'layouts.app' )

@section( 'content' )

    <v-content>

        <section>

            <v-parallax src="{{ asset( '/img/smolgirl.jpg' ) }}" height="700">

                <v-layout
                    column
                    :align-start=" !this.$vuetify.breakpoint.sm "
                    :align-center=" this.$vuetify.breakpoint.sm "
                    :justify-start=" !this.$vuetify.breakpoint.sm "
                    :justify-end=" this.$vuetify.breakpoint.sm || this.$vuetify.breakpoint.xs "
                >
                    <h1 class="main-hero-header text--lighten-3 grey--text">

                        The internets database for self improvement
                        @auth

                            <v-layout justify-center align-center>

                                <v-btn href="/dashboard" class="primary" >
                                    Go to Dashboard
                                </v-btn>
                            </v-layout>
                        @endauth
                    </h1>
                </v-layout>
            </v-parallax>
        </section>

        <section>

            <v-layout
                column
                wrap
                class="my-5"
                align-center>

                <v-flex xs12 sm4 class="mt-1 mb-5">

                    <div class="text-xs-center">

                        <h2 class="headline">A resource for optimizing your health</h2>

                        <span class="subheading">In today's world there is a huge need to stay on top of our health</span>
                    </div>
                </v-flex>
                <v-flex xs12>

                    <v-container grid-list-xl>

                        <v-layout row wrap align-center>

                            @foreach ( $infocards as $card )

                                <v-flex xs12 md4>

                                    <v-card class="elevation-0 transparent">

                                        <v-card-text class="text-xs-center">

                                            <v-icon x-large class="blue--text text--lighten-2">{{ $card[ 'icon' ] }}</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">

                                            <div class="headline text-xs-center">{{ $card[ 'title' ] }}</div>
                                        </v-card-title>
                                        <v-card-text>

                                            {{ $card[ 'body' ] }}
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            @endforeach
                        </v-layout>
                    </v-container>
                </v-flex>
            </v-layout>
        </section>

        <section>

            <v-parallax src="{{ asset( '/img/smallerclouds.jpg' ) }}" height="450">

                <v-layout column align-center justify-center>

                    <div class="headline white--text mb-3 text-xs-center">Begin your journey of self mastery</div>
                    <em>find your happiness today</em>
                    <login-button action=" null " class="mt-4"></login-button>
                </v-layout>
            </v-parallax>
        </section>

        <section>

            <v-container grid-list-xl>

                <v-layout row wrap justify-center class="my-5">

                    <v-flex xs12>

                        <v-card class="elevation-0 transparent">

                            <v-card-title primary-title class="layout justify-center">

                                <div class="headline">About Me</div>
                            </v-card-title>
                            <v-card-text>
                                <p>

                                    Programmer, 25, south florida, always experimenting with different products and techniques for self improvement. I bought my first EMS machine
                                    at 18, regularly cold plunge, eat whole ginger, got certified as a yoga instructor at 19, and am constantly learning about everything health and wellness related.
                                    Because I grew up with terrible posture playing video games and barely exercising, plus my current job as a programmer, I suffer from a few complications
                                    that have compelled me to learn everything that I am learning or else my day-to-day becomes a whole lot more painful. Things such as a minor scoliosis, fallen arches,
                                    slightly irregularly curved neck and hips, and lower spinal degeneration. The choices are clear to me: either I wallow in self-pity over the consequences of my unconscious
                                    behaviors when I was young, or spend my entire focus as an adult working to rise above the problems that I face.
                                </p>
                                <p>

                                    Essentially Thrivemind is the collection of everything that I've learned for myself, and all of the side-projects that I've wanted to build
                                    to help myself with my own self enhancement, published online and offered as a service for you to benefit from as well!
                                </p>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </section>
    </v-content>

    @include( 'layouts.footer' )
@endsection