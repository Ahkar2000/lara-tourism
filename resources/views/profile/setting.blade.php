@extends('layouts.app')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <!-- /# row -->
                <section id="main-content">
                    <div class="col-lg-12">
                        <div class="container">
                            <div class="row">
                                <div class="text-start d-flex align-items-center justify-content-between">
                                    <h4 class="fw-bolder mb-0">Account Details</h4>
                                    <div>
                                        <a href="{{ route('profile') }}" style="border: none!important;" class="btn-custom1">
                                            <i class="bi bi-caret-left-fill mt-1" style="font-size: 20px;"></i>  Back To Booking Lists
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <hr>
                                </div>
                                <div class="col-lg-6">
                                    <form action="{{ route('settingUpdate') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Account Name</label>
                                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name',Auth::user()->name) }}">
                                            @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email',Auth::user()->email) }}">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Current Password</label>
                                            <input type="password" name="password" class="form-control @if(session('error')) is-invalid @endif @error('password') is-invalid @enderror">
                                            @if(session('error'))
                                            <div class="invalid-feedback">
                                                {{ session('error') }}
                                            </div>
                                            @endif
                                            @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">New Password</label>
                                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror">
                                            @error('new_password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" name="cpassword" class="form-control @error('cpassword') is-invalid @enderror">
                                            @error('cpassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 text-end">
                                            <button style="border: none!important;" class="btn-custom1">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
