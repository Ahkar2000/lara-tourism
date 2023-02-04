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
                                <h3 class=" font-weight-bold">Destination Places</h3>
                                <div>
                                    <button data-toggle="modal" data-target="#exampleModal"
                                        class="btn btn-primary add-cat border-0 rounded-0" type="submit"
                                        style="background-color: #868e96;">
                                        <i class="ti-plus"></i> Add Place
                                    </button>
                                    <form action="{{ route('places.index') }}" method="GET" class="d-inline-block">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Search"
                                                aria-describedby="button-addon1" value="{{ request('search') }}"
                                                name="search">
                                            <div class="input-group-prepend">
                                                <button class="btn border" type="button" id="button-addon1"><i
                                                        class="ti-search"></i></button>
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
                                                <th>Name</th>
                                                <th>Created At</th>
                                                <th>Control</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($places as $key=>$place)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $place->name }}</td>
                                                    <td>{{ $place->created_at }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="btn border dropdown-toggle" href="#"
                                                                data-boundary="window" role="button" data-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Action
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item view-package" update-link="{{ route('places.update',$place->id) }}" data-id="{{ $place->id }}" data-link="{{ route('places.show',$place->id) }}" >
                                                                    <i class="bi bi-pencil-square text-info"></i> Edit
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <form
                                                                    action="{{ route('places.destroy', $place->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button class="dropdown-item" id="idelete"
                                                                        type="submit"> <i class="text-danger ti-trash"></i>
                                                                        Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">There is no data yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $places->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Place</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update-cat-form" action="" method="POST">
                        @csrf
                        @method('put')
                        <label for="" class="form-label">Place
                            Name</label>
                        <input type="text" name="new_name"
                            class="form-control cat-name @error('new_name') is-invalid @enderror">
                        @error('new_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="update-cat-form" type="submit" class="btn btn-secondary rounded-0">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Place</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-cat-form" action="{{ route('places.store') }}" method="POST">
                        @csrf
                        <label for="" class="form-label">Place Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </form>
                </div>
                <div class="modal-footer">
                    <button form="add-cat-form" type="submit" class="btn btn-secondary rounded-0">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        @error('name')
            $("#exampleModal").modal('show')
        @enderror

        @error('new_name')
            $("#update-modal").modal('show')
        @enderror

        $('#idelete').on("click", function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Are you sure to delete this place?',
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

        $('.view-package').on('click',function(){
            let link = $(this).attr('data-link')
            let catId = $(this).attr('data-id')
            let updateLink = $(this).attr('update-link')
            $.get(link,function(data){
                $('#update-modal').modal('show')
                $('.cat-name').val(data.name)
                $('#update-cat-form').attr('action',updateLink)
            })
        })
    </script>
@endpush
