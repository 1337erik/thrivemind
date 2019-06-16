<nav class="navbar navbar-expand-lg">

    <div class="container-fluid">

        <div class="navbar-wrapper">

            <div class="navbar-minimize">

                <button id="minimizeSidebar" class="btn btn-info btn-fill btn-round btn-icon d-none d-lg-block">

                    <i class="fas fa-chevron-left visible-on-sidebar-regular"></i>
                    <i class="fas fa-chevron-right visible-on-sidebar-mini"></i>
                </button>
            </div>
        </div>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
            <span class="navbar-toggler-bar burger-lines"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end">

            {{-- <ul class="nav navbar-nav mr-auto">

                <form class="navbar-form navbar-left navbar-search-form" role="search">

                    <div class="input-group">

                        <i class="nc-icon nc-zoom-split"></i>
                        <input type="text" value="" class="form-control" placeholder="Search...">
                    </div>
                </form>
            </ul> --}}
            <ul class="navbar-nav">

                <li class="dropdown nav-item">

                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                        <i class="nc-icon nc-planet"></i>
                    </a>
                    <ul class="dropdown-menu">

                        <a class="dropdown-item" href="#">Create New Post</a>
                        <a class="dropdown-item" href="#">Manage Something</a>
                        <a class="dropdown-item" href="#">Do Nothing</a>
                        <a class="dropdown-item" href="#">Submit to live</a>
                        <li class="divider"></li>
                        <a class="dropdown-item" href="#">Another action</a>
                    </ul>
                </li>
                <li class="dropdown nav-item">

                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">

                        <i class="nc-icon nc-bell-55"></i>
                        <span class="notification">5</span>
                        <span class="d-lg-none">Notification</span>
                    </a>
                    <ul class="dropdown-menu">

                        <a class="dropdown-item" href="#">Notification 1</a>
                        <a class="dropdown-item" href="#">Notification 2</a>
                        <a class="dropdown-item" href="#">Notification 3</a>
                        <a class="dropdown-item" href="#">Notification 4</a>
                        <a class="dropdown-item" href="#">Notification 5</a>
                    </ul>
                </li>
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="nc-icon nc-bullet-list-67"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">

                        <a class="dropdown-item" href="#">

                            <i class="nc-icon nc-email-85"></i> Messages
                        </a>
                        <a class="dropdown-item" href="#">

                            <i class="nc-icon nc-umbrella-13"></i> Help Center
                        </a>
                        <a class="dropdown-item" href="#">

                            <i class="nc-icon nc-settings-90"></i> Settings
                        </a>
                        <div class="divider"></div>

                        <a class="dropdown-item" href="#">

                            <i class="nc-icon nc-lock-circle-open"></i> Lock Screen
                        </a>
                        <a href="#" class="dropdown-item text-danger">

                            <i class="nc-icon nc-button-power"></i> Log out
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>