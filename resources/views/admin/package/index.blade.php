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
                                <h3 class="font-weight-bold">Packages</h3>
                                <div>
                                    <a href="{{ route('packages.create') }}" class="btn btn-primary border-0 rounded-0" type="submit" style="background-color: #868e96;">
                                        <i class="ti-plus"></i>  Add Package
                                    </a>
                                    <form action="{{ route('packages.index') }}" method="GET" class="d-inline-block">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search" aria-describedby="button-addon1" value="{{ request('search') }}" name="search">
                                            <div class="input-group-prepend">
                                              <button class="btn border" type="button" id="button-addon1"><i class="ti-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- <div class="card-body"> --}}
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped table-hover border rounded">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Package Name</th>
                                                <th>Location</th>
                                                <th>Price</th>
                                                <th>Description</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($packages as $key=>$package)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $package->name }}</td>
                                                    <td>{{ Str::limit($package->location, 20, '...') }}</td>
                                                    <td>{{ $package->price }}</td>
                                                    <td>{{ Str::limit($package->description, 20, '...') }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="btn border dropdown-toggle" href="#" data-boundary="window"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                Action
                                                            </a>

                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item view-package" href="{{ route('packages.show',$package->id) }}"> 
                                                                    <i class="ti-file text-warning"></i>  View
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item view-package" href="{{ route('packages.edit',$package->id) }}"> 
                                                                    <i class="bi bi-pencil-square text-info"></i>  Edit
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <form action="{{ route('packages.destroy', $package->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="dropdown-item" id="idelete" type="submit"> <i
                                                                            class="text-danger ti-trash"></i>
                                                                        Delete</button>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr >
                                                    <td colspan="6" class="text-center">Three is no data.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $packages->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script type="module">
        $(document).ready(function() {

            $('#idelete').on("click",function(e){
                e.preventDefault()
                Swal.fire({
                title: 'Are you sure to delete this package?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('form').trigger('submit')
                }
                })
            })
            
            $('.view-package').on("click",function (e) {  
            $(this).closest('tr').find('.status').html('<span class="badge badge-success">Read</span>')
            let link = $(this).attr('data-link')
            $.get(link,function(data){
                $('#iname').html(data.name)
                $('#iemail').html(data.email)
                $('#isubject').html(data.subject)
                $('#imessage').html(data.message)
                })
            })
        });
        
    </script>
@endpush
