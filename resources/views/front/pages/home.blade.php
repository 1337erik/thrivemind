@extends( 'layouts.front' )

@section( 'content' )

    <div class="parallax filter-gradient blue" data-color="blue">

        <div class="parallax-background">

            <img class="parallax-background-image" src="{{ url( '/img/front/bg3.jpg' ) }}" >
        </div>
        <div class="container">

            <div class="row">

                <div class="col-md-5 hidden-sm hidden-xs">

                    <div class="parallax-image">

                        <img class="phone" src="{{ url( '/img/front/iphone3.png' ) }}" style="margin-top: 20px"/>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-1">

                    <div class="description">

                        <h2>Welcome to the next wave</h2>
                        <br>
                        <h5>
                            Starting as my personal research in how I can live better and help myself grow, thrivemind became
                            how I help my immediate friends and family help themselves until it naturally devleped into something
                            I figured I ought to share. Thrivemind is for education, ideas, growth, and <b>accountability</b>.
                        </h5>
                    </div>
                    <div class="buttons">


                        <a href="/login">
                            <button class="btn btn-fill btn-neutral">

                            <i class="fas fa-user-astronaut"></i> Sign In
                        </button></a>

                        <a href="https://www.youtube.com/channel/UC8bxu_Su1Jt6GxT1Roxu1lg" target="_blank">
                            <button class="btn btn-simple btn-neutral" style="font-size: 16px">

                            <i class="fab fa-youtube"></i> Learn
                        </button></a>

                        <a href="https://www.instagram.com/thrivemindsociety/" target="_blank">
                            <button class="btn btn-simple btn-neutral" style="font-size: 16px">

                            <i class="fab fa-instagram"></i> Engage
                        </button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-presentation">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div class="description">

                        <h4 class="header-text">Thrivemind Webapp</h4>
                        <p>
                            A set of tools that I created myself starting as a programmable timer and a todo-list. I was trying to learn new programming technology
                            while also creating practical tools that I could also actually use, improving upon the existing apps I already used.
                        </p>
                        <p>
                            Also an interactive knowledge-base that links together every concept, tool and resource I've ever created.
                            You gain access to the ThriveMind itself.
                        <p>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1 hidden-xs">

                    <img src="{{ url( '/img/front/mac.png' ) }}"/>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-demo">

        <div class="container">

            <div class="row">

                <div class="col-md-6">

                    <div id="description-carousel" class="carousel fade" data-ride="carousel">

                        <div class="carousel-inner">

                            <div class="item">

                                <img src="{{ url( '/img/front/home_33.jpg' ) }}" alt="">
                            </div>
                            <div class="item active">

                                <img src="{{ url( '/img/front/home_22.jpg' ) }}" alt="">
                            </div>
                            <div class="item">

                                <img src="{{ url( '/img/front/home_11.jpg' ) }}" alt="">
                            </div>
                        </div>
                        <ol class="carousel-indicators carousel-indicators-blue">

                            <li data-target="#description-carousel" data-slide-to="0" class=""></li>
                            <li data-target="#description-carousel" data-slide-to="1" class="active"></li>
                            <li data-target="#description-carousel" data-slide-to="2" class=""></li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-5 col-md-offset-1">

                    <h4 class="header-text">Simple, Fun, Enhancing</h4>
                    <p>
                        This is a one-stop platform for a community that will help you grow, actualize your potential,
                        track your progress, and provide you the tools that you need for success
                    </p>
                    <a href="/login" id="Demo3" class="btn btn-fill btn-info" data-button="info">Get Started</a>
                </div>
            </div>
        </div>
    </div>

    <div class="section section-features">

        <div class="container">

            <h4 class="header-text text-center">Features</h4>
            <div class="row">

                <div class="col-md-4">

                    <div class="card card-blue">

                        <div class="icon">

                            <i class="pe-7s-note2"></i>
                        </div>
                        <div class="text">

                            <h4>Todo-List</h4>
                            <p>
                                Stay up-to-date with the things you want to be doing, and track your progress along the way.
                                Share your progress with your community, and invite friends to participate in challenges.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="card card-blue">

                        <div class="icon">

                            <i class="pe-7s-bell"></i>
                        </div>
                        <h4>Smart Notifications</h4>
                        <p>
                            Notifications via webapp, email or text message that will remind you of imporatant things. You can set reminders to
                            keep yourelf ahead of the curve.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">

                    <div class="card card-blue">

                        <div class="icon">

                            <i class="pe-7s-graph1"></i>
                        </div>
                        <h4>Analytics and Community</h4>
                        <p>
                            Learn more insights about yourself, and your immediate community. Invite friends and family to see your progress and participate in
                            their own growth alongside you. Engage and compete in a world-wide community.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="section section-testimonial">

        <div class="container">

            <h4 class="header-text text-center">What people think</h4>
            <div id="carousel-example-generic" class="carousel fade" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">

                    <div class="item">

                        <div class="mask">

                            <img src="{{ url( '/img/front/faces/face-4.jpg' ) }}">
                        </div>
                        <div class="carousel-testimonial-caption">

                            <p>Jay Z, Producer</p>
                            <h3>"I absolutely love your app! It's truly amazing and looks awesome!"</h3>
                        </div>
                    </div>
                    <div class="item active">

                        <div class="mask">

                            <img src="{{ url( '/img/front/faces/face-3.jpg' ) }}">
                        </div>
                        <div class="carousel-testimonial-caption">

                            <p>Drake, Artist</p>
                            <h3>"This is one of the most awesome apps I've ever seen! Wish you luck Creative Tim!"</h3>
                        </div>
                    </div>
                    <div class="item">

                        <div class="mask">

                            <img src="{{ url( '/img/front/faces/face-2.jpg' ) }}">
                        </div>
                        <div class="carousel-testimonial-caption">

                            <p>Rick Ross, Musician</p>
                            <h3>"Loving this! Just picked it up the other day. Thank you for the work you put into this."</h3>
                        </div>
                    </div>
                </div>
                <ol class="carousel-indicators carousel-indicators-blue">

                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
            </div>
        </div>
    </div> --}}

    <div class="section section-no-padding">

        <div class="parallax filter-gradient blue" data-color="blue">

            <div class="parallax-background">

                <img class="parallax-background-image" src="{{ url( '/img/front/bg3.jpg' ) }}" >
            </div>
            <div class="container">

                <div class="info">

                    <h1>Claim your space in the ThriveMind</h1>
                    <p>Learn. Grow. Develop. Master Yourself. Help Others. Find Peace. Change The World.</p>
                    <a href="/login" class="btn btn-neutral btn-lg btn-fill">Get Started</a>
                </div>
            </div>
        </div>
    </div>
@endsection