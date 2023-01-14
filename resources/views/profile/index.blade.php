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
                                <div class="text-start">
                                    <h4 class="fw-bolder">Booked Packages</h4>
                                    <hr>
                                </div>
                                <div>
                                    <div class="table-responsive">
                                        <table id="myTable" class="table table-striped table-hover border rounded">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>DateTime</th>
                                                    <th>Package</th>
                                                    <th>Schedule</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($bookings as $key => $booking)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $booking->created_at }}</td>
                                                        <td>{{ $booking->package->name }}</td>
                                                        <td class="sd">{{ $booking->schedule }}</td>
                                                        <td class="qt">{{ $booking->quantity }}</td>
                                                        <td class="status">
                                                            @if ($booking->status == 0)
                                                                <span class="badge rounded-0 text-bg-warning">Pending</span>
                                                            @elseif ($booking->status == 1)
                                                                <span class="badge rounded-0 text-bg-info">Confirmed</span>
                                                            @elseif ($booking->status == 2)
                                                                <span class="badge rounded-0 text-bg-success">Done</span>
                                                            @elseif ($booking->status == 3)
                                                                <span class="badge rounded-0 text-bg-danger">Cancelled</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($booking->status == '0' || $booking->status == '1')
                                                            <div class="dropdown">
                                                                <button class="btn btn-outline-secondary rounded-0 dropdown-toggle"
                                                                    type="button" data-bs-toggle="dropdown"
                                                                    aria-expanded="false">
                                                                    Action
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal{{$key}}">Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <hr class="dropdown-divider">
                                                                    </li>
                                                                    <li><a class="dropdown-item cancel-btn" href="{{ route('bookCancel',$booking->id) }}">Cancel</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="modal fade rounded-0" id="exampleModal{{$key}}"
                                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content rounded-0">
                                                                        <div class="modal-header">
                                                                            <h1 class="modal-title fs-5"
                                                                                id="exampleModalLabel">Book Now</h1>
                                                                            <button type="button"
                                                                                class="btn-close rounded-0"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form id="book-form{{$key}}"
                                                                                action="{{ route('bookUpdate',$booking->id) }}"
                                                                                method="POST" class="book">
                                                                                @csrf
                                                                                @method('put')
                                                                                <input type="hidden" name="package_id"
                                                                                    value="{{ $booking->package_id }}">
                                                                                <div class="mb-3">
                                                                                    <label class="form-label">Number of
                                                                                        People</label>
                                                                                    <input type="number" name="quantity"
                                                                                        class="form-control" id="qty" value="{{ $booking->quantity }}">
                                                                                </div>
                                                                                <div class="my-3">
                                                                                    <label class="form-label">Booking
                                                                                        Date</label>
                                                                                    <input type="date" name="schedule"
                                                                                        class="form-control" id="schedule" value="{{ $booking->schedule }}">
                                                                                </div>
                                                                                <hr>
                                                                                <div class="text-end mt-3">
                                                                                    <button style="border: none!important;"
                                                                                        class="btn-custom1">Update</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="mt-3">
                                            {{ $bookings->links() }}
                                        </div>
                                    </div>
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
    <script>
        $(document).ready(function(){
            $('.cancel-btn').on('click',function(e){
                $(this).closest('tr').find('.status').html(`<span class="badge rounded-0 text-bg-danger">Cancelled</span>`)
                e.preventDefault()
                let link = $(this).attr('href')
                $.get(link,function(data){
                    if(data == 'success'){
                        showToast("Your Booking is cancelled successfully.")
                    }
                })
            })

            $('.book').on('submit',function(e){
                e.preventDefault()
                let input = $(this).serialize()
                $.post($(this).attr('action'),input, function(data){
                    $('.modal').modal('hide')
                    $(this).closest('tr').find('.sd').html(data.schedule)
                    $(this).closest('tr').find('.qt').html(data.quantity)
                    $(this).children('#qty').val(data.quantity)
                    $(this).children('#schedule').val(data.schedule)
                    showToast("Your Booking is updated successfully.")
                })
            })
        })
    </script>
@endpush
