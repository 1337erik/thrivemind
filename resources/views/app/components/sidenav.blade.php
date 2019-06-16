{{--
    Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
    Tip 2: you can also add an image using data-image tag
--}}
<div class="sidebar" data-color="azure" data-image="{{ url( '/img/app/sidebar-5.jpg' ) }}">

    <div class="sidebar-wrapper">

        <div class="logo">

            <a href="/dashboard" class="simple-text logo-mini">
                TM
            </a>
            <a href="/dashboard" class="simple-text logo-normal">
                ThriveMind
            </a>
        </div>

        <div class="user">

            <div class="photo">

                <img src="{{ url( '/img/app/default-avatar.png' ) }}" />
            </div>
            <div class="info">

                <a data-toggle="collapse" href="#collapseExample" class="collapsed" style="margin-bottom: 5px;">

                    <span>

                        {{ Auth::user()->name }}
                        <b class="caret"></b>
                    </span>
                </a>
                <div class="collapse" id="collapseExample">

                    <ul class="nav">

                        <li>

                            <a class="profile-dropdown" href="#pablo">

                                <span class="sidebar-mini">MP</span>
                                <span class="sidebar-normal">My Profile</span>
                            </a>
                        </li>
                        <li>

                            <a class="profile-dropdown" href="#pablo">

                                <span class="sidebar-mini">S</span>
                                <span class="sidebar-normal">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul class="nav">

            <li class="nav-item ">

                <a class="nav-link" href="/dashboard">

                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#componentsExamples">

                    <i class="nc-icon nc-app"></i>
                    <p>
                        Tools
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="componentsExamples">

                    <ul class="nav">

                        <li class="nav-item ">

                            <a class="nav-link" href="/timeboxer">

                                <span class="sidebar-mini">SW</span>
                                <span class="sidebar-normal">Stop Watch</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">

                <a class="nav-link" href="/home">

                    <i class="nc-icon nc-single-copy-04"></i>
                    <p>Tasks</p>
                </a>
            </li>
            <li class="nav-item ">

                <a class="nav-link" href="/home">

                    <i class="nc-icon nc-chart-bar-32"></i>
                    <p>Analytics</p>
                </a>
            </li>
            <li class="nav-item ">

                <a class="nav-link" href="/home">

                    <i class="nc-icon nc-planet"></i>
                    <p>Community</p>
                </a>
            </li>
            <li class="nav-item ">

                <a class="nav-link" href="/home">

                    <i class="nc-icon nc-atom"></i>
                    <p>Knowledge</p>
                </a>
            </li>
        </ul>
    </div>
</div>