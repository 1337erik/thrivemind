@extends('layouts.app')

@section('content')

    <div id="app" class="wrapper wrapper-full-page">

        @include( 'app.components.topnav' )

        <div class="full-page section-image" data-color="azure" data-image="{{ url( '/img/app/full-screen-image-3.jpg' ) }}" >

            <div class="content">

                <div class="container">

                    <div class="col-sm-6 ml-auto mr-auto">

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="card card-login card-hidden">

                                <div class="card-header ">

                                    <h3 class="header text-center">{{ __( 'Reset Password' ) }}</h3>
                                </div>
                                <div class="card-body">

                                    <div class="card-body">

                                        @if ( session( 'status' ) )

                                            <div class="alert alert-success" role="alert">

                                                {{ session( 'status' ) }}
                                            </div>
                                        @endif

                                        <div class="form-group">

                                            <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer ml-auto mr-auto">

                                    <button type="submit" class="btn btn-warning btn-block">{{ __('Send Password Reset Link') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection