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
                                <h3 class=" font-weight-bold">Users</h3>
                                <div>
                                    <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
                                        <i class="ti-plus"></i>  Add User
                                    </a>
                                    <form action="{{ route('admin.showUsers') }}" method="GET" class="d-inline-block">
                                        <div class="d-flex ">
                                            <div class="mb-3 ml-2">
                                                <input type="text" placeholder="Search" class="form-control"
                                                    value="{{ request('search') }}" name="search">
                                            </div>
                                            <div class="">
                                                <button class="btn border">
                                                    <i class="ti-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped table-hover border rounded">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Bookings</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $key=>$user)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->bookings->count() }}</td>
                                                    <td>{{ $user->created_at }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">Three is no data.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
