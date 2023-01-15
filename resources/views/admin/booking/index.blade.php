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
                                <h3 class=" font-weight-bold">Bookings</h3>
                                <form action="{{ route('bookings.index') }}" method="GET" class="d-inline-block">
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="myTable" class="table table-striped table-hover border rounded">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>User Name</th>
                                                <th>Package Name</th>
                                                <th>Schedule</th>
                                                <th>People</th>
                                                <th>Status</th>
                                                <th>DateTime</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($bookings as $key=>$booking)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="user-name">{{ $booking->user->name }}</td>
                                                    <td class="package-name">{{ $booking->package->name }}</td>
                                                    <td>{{ $booking->schedule }}</td>
                                                    <td>{{ $booking->quantity }}</td>
                                                    <td>
                                                        @if ($booking->status == 0)
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif ($booking->status == 1)
                                                            <span class="badge badge-primary">Confirmed</span>
                                                        @elseif ($booking->status == 2)
                                                            <span class="badge badge-success">Done</span>
                                                        @elseif ($booking->status == 3)
                                                            <span class="badge badge-danger">Cancelled</span>
                                                        @endif
                                                    </td>
                                                    <td class="date-time">{{ $booking->created_at }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a class="btn border dropdown-toggle" href="#" data-boundary="window"
                                                                role="button" data-toggle="dropdown" aria-expanded="false">
                                                                Action
                                                            </a>

                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item view-booking"
                                                                    data-id="{{ $booking->id }}" data-toggle="modal"
                                                                    data-target="#staticBackdrop"
                                                                    data-link="{{ route('bookings.show', $booking->id) }}">
                                                                    <i class="text-warning ti-file"></i> View</a>
                                                                <div class="dropdown-divider"></div>
                                                                <form
                                                                    action="{{ route('bookings.destroy', $booking->id) }}"
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
                                                <div class="modal fade" id="staticBackdrop" data-backdrop="static"
                                                    data-keyboard="false" tabindex="-1"
                                                    aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Bookings
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="font-weight-bold">User Name : <span
                                                                        class="font-weight-normal" id="name"></span>
                                                                </p>
                                                                <p class="font-weight-bold">Pacakge Name : <span
                                                                        class="font-weight-normal" id="package"></span>
                                                                </p>
                                                                <p class="font-weight-bold">People : <span
                                                                        class="font-weight-normal" id="quantity"></span>
                                                                </p>
                                                                <p class="font-weight-bold">Schedule : <span
                                                                        class="font-weight-normal" id="schedule"></span>
                                                                </p>
                                                                <p class="font-weight-bold">DateTime : <span
                                                                        class="font-weight-normal" id="created-at"></span>
                                                                </p>
                                                                @if(request('status') == 'pending' || request('status') == 'confirm')
                                                                <p class="font-weight-bold">Status</p>
                                                                <form action="{{ route('bookings.update', $booking->id) }}"
                                                                    method="POST" id="update-form">
                                                                    @csrf
                                                                    @method('put')
                                                                    <select name="status" class="form-control">
                                                                        @if (request('status') == 'pending')
                                                                            <option value="0">Pending</option>
                                                                            <option value="1">Confirmed</option>
                                                                        @endif
                                                                        <option value="2">Done</option>
                                                                        <option value="3">Cancelled</option>
                                                                    </select>
                                                                </form>
                                                                @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                @if(request('status') == 'pending' || request('status') == 'confirm')
                                                                <button class="btn btn-primary" id="update-button"
                                                                    type="submit" form="update-form">Update</button>
                                                                @endif
                                                                <button class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancel</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <tr>
                                                    <td colspan="8" class="text-center">Three is no data.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    {{ $bookings->links() }}
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
                title: 'Are you sure to delete this booking?',
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

            $('.view-booking').on("click",function (e) {
            let userName = $(this).closest('tr').find('.user-name').html()
            let packageName = $(this).closest('tr').find('.package-name').html()
            let dateTime = $(this).closest('tr').find('.date-time').html()
            let link = $(this).attr('data-link')
            $.get(link,function(data){
                $('#name').html(userName)
                $('#package').html(packageName)
                $('#created-at').html(dateTime)
                $('#schedule').html(data.schedule)
                $('#quantity').html(data.quantity)
                })
            })

        });
        
    </script>
@endpush
