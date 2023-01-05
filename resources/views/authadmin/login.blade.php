@extends('authadmin.master')

@section('content')

<div class="unix-login">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="login-content">
                    <div class="login-form">
                        <h4 class="mb-0">Administratior Login</h4>
                        <hr>
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf
                            <div class="form-group">
                                <label>Email address</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <a href="{{ route('home') }}">
                                    <h6 class="mb-0 text-primary">
                                       <- Go To Website
                                    </h6>
                                </a>
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection