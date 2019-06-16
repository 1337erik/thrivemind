@extends( 'layouts.app' )

@section('content')

    <div id="app" class="wrapper wrapper-full-page">

        @include( 'app.components.topnav' )

        <div class="full-page section-image" data-color="azure" data-image="{{ url( '/img/app/full-screen-image-3.jpg' ) }}" >

            <div class="content">

                <div class="container">

                    <div class="col-sm-6 ml-auto mr-auto">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="card card-login card-hidden">

                                <div class="card-header ">

                                    <h3 class="header text-center">{{ __( 'Login' ) }}</h3>
                                </div>
                                <div class="card-body">

                                    <div class="card-body">

                                        <div class="form-group">

                                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">

                                            <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>

                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">

                                            <div class="form-check">

                                                <label class="form-check-label" for="remember">
                                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <span class="form-check-sign"></span>
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ml-auto mr-auto">

                                    <button type="submit" class="btn btn-warning btn-block">{{ __( 'Login' ) }}</button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection