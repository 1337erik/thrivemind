@extends( 'layouts.app' )

@section( 'content' )

    <div id="app" class="wrapper wrapper-full-page">

        @include( 'app.components.topnav' )

        <div class="full-page register-page section-image" data-color="azure" data-image="{{ url( '/img/app/full-screen-image-3.jpg' ) }}">

            <div class="content">

                <div class="container">

                    <div class="card card-register card-plain text-center">

                        <div class="card card-register card-plain text-center">
                            <div class="card-header ">
                                <div class="row  justify-content-center">
                                    <div class="col-md-8">
                                        <div class="header-text">
                                            <h2 class="card-title">ThriveMind Society</h2>
                                            <h4 class="card-subtitle">Register for free and experience the Growth Revolution</h4>
                                            <hr />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="icon">
                                                    <i class="nc-icon nc-circle-09"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4>Free Account</h4>
                                                <p>
                                                    Sign up and explore aa base-level access, try it out risk-free and see if you'd like to take your
                                                    engagement to the next level afterwards
                                                </p>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="icon">
                                                    <i class="nc-icon nc-preferences-circle-rotate"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4>Awesome Performances</h4>
                                                <p>
                                                    Community, Tools, Educational Materials, Analytics, and One-On-One Help by myself
                                                </p>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left">
                                                <div class="icon">
                                                    <i class="nc-icon nc-planet"></i>
                                                </div>
                                            </div>
                                            <div class="media-body">
                                                <h4>Global Support</h4>
                                                <p>
                                                    Here at ThriveMind the goal is to spread world-wide, giving everyone the opportunities that they deserve as people to
                                                    thrive in an otherwise uncertain world
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mr-auto">

                                        <form method="POST" action="{{ route('register') }}">
                                            @csrf

                                            <div class="card card-plain">

                                                <div class="content">

                                                    <div class="form-group">

                                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}">

                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">

                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}">

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">

                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">

                                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                                                    </div>
                                                </div>
                                                <div class="footer text-center">

                                                    <button type="submit" class="btn btn-fill btn-neutral btn-wd">
                                                        {{ __( 'Create Free Account' ) }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection