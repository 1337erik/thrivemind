<nav class="navbar navbar-transparent navbar-top" role="navigation">

    <div class="container">

        <div class="navbar-header">

            <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">

                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a href="/">

                <div class="logo-container">

                    <div class="logo">

                        <img src="{{ url( '/img/front/new_logo.png' ) }}" alt="Creative Tim Logo">
                    </div>
                    <div class="brand">

                        ThriveMind Society
                    </div>
                </div>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="example" >

            <ul class="nav navbar-nav navbar-right">

                <li>

                    <a href="https://www.youtube.com/channel/UC8bxu_Su1Jt6GxT1Roxu1lg" target="_blank">

                        <i class="fab fa-youtube"></i>
                        <span class="visible-xs-inline-block">Youtube</span>
                    </a>
                </li>
                <li>

                    <a href="https://www.facebook.com/thrivemindsociety-436436193573218/" target="_blank">

                        <i class="fab fa-facebook-square"></i>
                        <span class="visible-xs-inline-block">Facebook</span>
                    </a>
                </li>
                <li>

                    <a href="https://www.instagram.com/thrivemindsociety/" target="_blank">

                        <i class="fab fa-instagram"></i>
                        <span class="visible-xs-inline-block">Instagram</span>
                    </a>
                </li>
                <li>

                    <a href="https://medium.com/@erik_develops" target="_blank">

                        <i class="fab fa-medium"></i>
                        <span class="visible-xs-inline-block">Medium</span>
                    </a>
                </li>
                <li>

                    <a href="https://www.reddit.com/user/thrivemindsociety" target="_blank">

                        <i class="fab fa-reddit-square"></i>
                        <span class="visible-xs-inline-block">Reddit</span>
                    </a>
                </li>
                @auth

                    <li>

                        <a href="/dashboard">

                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>

                        <a class="dropdown-item" href="{{ route( 'logout' ) }}"
                            onclick="event.preventDefault();
                                            document.getElementById( 'logout-form' ).submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            {{ __( 'Sign Out' ) }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
                @guest

                    <li>

                        <a href="/login">

                            <i class="fas fa-sign-in-alt"></i>
                            Sign In
                        </a>
                    </li>
                    <li>

                        <a href="/register">

                            <i class="fas fa-user-astronaut"></i>
                            Sign Up
                        </a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>