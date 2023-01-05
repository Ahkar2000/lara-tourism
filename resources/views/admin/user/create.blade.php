@extends('admin.layouts.admin')

@section('content')
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <!-- /# row -->
                <section id="main-content">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-title pr d-flex justify-content-between align-items-center">
                                <h3 class="mb-0 font-weight-bold">Add User</h3>
                            </div>
                            <hr>
                            <div class="card-body">
                                <form action="{{ route('admin.users.save') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">User Name</label>
                                        <input name="name" value="{{ old('name') }}" type="text" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Email</label>
                                        <input name="email" value="{{ old('email') }}" type="address" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Password</label>
                                        <input name="password" value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="" class=" font-weight-bold">Confirm Password</label>
                                        <input name="confirm-password" value="{{ old('confirm-password') }}" type="password" class="form-control @error('confirm-password') is-invalid @enderror">
                                        @error('confirm-password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group float-right">
                                        <a href="{{ route('packages.index') }}" class="btn btn-secondary">Back</a>
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection