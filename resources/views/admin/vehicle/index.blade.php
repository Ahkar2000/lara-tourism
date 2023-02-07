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
                                <h3 class=" font-weight-bold">Vehicles</h3>
                                <div>
                                    <button data-toggle="modal" data-target="#exampleModal"
                                        class="btn btn-primary add-cat border-0 rounded-0" type="submit"
                                        style="background-color: #868e96;">
                                        <i class="ti-plus"></i> Add Vehicle
                                    </button>
                                    <form action="{{ route('vehicles.index') }}" method="GET" class="d-inline-block">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" vehicleholder="Search"
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
                                                <th>Model</th>
                                                <th>Seats</th>
                                                <th>Driver Name</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                                <th>Control</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($vehicles as $key=>$vehicle)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $vehicle->model }}</td>
                                                    <td>{{ $vehicle->seat }}</td>
                                                    <td>{{ $vehicle->driver }}</td>
                                                    <td>{{ $vehicle->price }}</td>
                                                    <td>
                                                        @if ($vehicle->status == 1)
                                                            <span class="badge badge-success rounded-0">Avaliable</span>
                                                        @elseif($vehicle->status == 0)
                                                            <span class="badge badge-danger rounded-0">Not Avaliable</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $vehicle->created_at }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="btn border dropdown-toggle" href="#"
                                                                data-boundary="window" role="button" data-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Action
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item view-package" update-link="{{ route('vehicles.update',$vehicle->id) }}" data-id="{{ $vehicle->id }}" data-link="{{ route('vehicles.show',$vehicle->id) }}" >
                                                                    <i class="bi bi-pencil-square text-info"></i> Edit
                                                                </a>
                                                                <div class="dropdown-divider"></div>
                                                                <form
                                                                    action="{{ route('vehicles.destroy', $vehicle->id) }}"
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
                                                    <td colspan="8" class="text-center">There is no data yet.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $vehicles->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    {{-- Update Modal --}}
    <div class="modal fade" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update-cat-form" action="" method="POST">
                        @csrf
                        @method('put')
                        <label for="" class="form-label">Vehicle Model</label>
                        <input type="text" name="new_model" value="{{ old('new_model') }}"
                            class="new-model form-control @error('new_model') is-invalid @enderror">
                        @error('new_model')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="" class="form-label">Seats</label>
                        <input type="number" name="new_seat" value="{{ old('new_seat') }}"
                            class="new-seat form-control @error('new_seat') is-invalid @enderror">
                        @error('new_seat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="" class="form-label">Driver Name</label>
                        <input type="text" name="new_driver" value="{{ old('new_driver') }}"
                            class="new-driver form-control @error('new_driver') is-invalid @enderror">
                        @error('new_driver')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="" class="form-label">Price</label>
                        <input type="number" name="new_price" value="{{ old('new_price') }}"
                            class="new-price form-control @error('new_price') is-invalid @enderror">
                        @error('new_price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="" class="form-label">Status</label>
                        <select name="new_status" class=" form-control @error('new_status') is-invalid @enderror">
                            <option value="1" class="new-status-one">Avaliable</option>
                            <option value="0" class="new-status-two">Not Avaliable</option>
                        </select>
                        @error('new_status')
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

    <!-- Add Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-cat-form" action="{{ route('vehicles.store') }}" method="POST">
                        @csrf
                        <label for="" class="form-label">Vehicle Model</label>
                        <input type="text" name="model" value="{{ old('model') }}"
                            class="form-control @error('model') is-invalid @enderror">
                        @error('model')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="" class="form-label">Seats</label>
                        <input type="number" name="seat" value="{{ old('seat') }}"
                            class="form-control @error('seat') is-invalid @enderror">
                        @error('seat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="" class="form-label">Driver Name</label>
                        <input type="text" name="driver" value="{{ old('driver') }}"
                            class="form-control @error('driver') is-invalid @enderror">
                        @error('driver')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="" class="form-label">Price</label>
                        <input type="number" name="price" value="{{ old('price') }}"
                            class="form-control @error('price') is-invalid @enderror">
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="" class="form-label">Status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="1">Avaliable</option>
                            <option value="0">Not Avaliable</option>
                        </select>
                        @error('status')
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
        @error('model') 
            $("#exampleModal").modal('show')
        @enderror
        @error('price') 
            $("#exampleModal").modal('show')
        @enderror
        @error('status') 
            $("#exampleModal").modal('show')
        @enderror
        @error('driver') 
            $("#exampleModal").modal('show')
        @enderror
        @error('seat') 
            $("#exampleModal").modal('show')
        @enderror

        @error('new_name')
            $("#update-modal").modal('show')
        @enderror
        @error('new_price') 
            $("#update-modal").modal('show')
        @enderror
        @error('new_status') 
            $("#update-modal").modal('show')
        @enderror
        @error('new_driver') 
            $("#update-modal").modal('show')
        @enderror
        @error('new_seat') 
            $("#update-modal").modal('show')
        @enderror

        $('#idelete').on("click", function(e) {
            e.preventDefault()
            Swal.fire({
                title: 'Are you sure to delete this vehicle?',
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
                $('.new-model').val(data.model)
                $('.new-driver').val(data.driver)
                $('.new-price').val(data.price)
                $('.new-seat').val(data.seat)
                if($('.new-status-one').attr('value') == data.status){
                    $('.new-status-one').prop('selected',true)
                }
                if($('.new-status-two').attr('value') == data.status){
                    $('.new-status-two').prop('selected',true)
                }
                $('#update-cat-form').attr('action',updateLink)
            })
        })
    </script>
@endpush
