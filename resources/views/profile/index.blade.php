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
                                    <h4 class="fw-bolder mb-0">Booked Packages</h4>
                                    <div>
                                        <a href="{{ route('setting') }}" style="border: none!important;" class="btn-custom1">
                                            <i class="bi bi-person-fill-gear" style="font-size: 20px;"></i> Manage Account
                                        </a>
                                    </div>
                                </div>
                                <div>
                                    <hr>
                                    <div class="table-responsive overflow-visible">
                                        <table id="myTable" class="table table-striped table-hover border rounded">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>DateTime</th>
                                                    <th>Booking ID</th>
                                                    <th>Package</th>
                                                    <th>Schedule</th>
                                                    <th>Quantity</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($bookings as $key => $booking)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $booking->created_at }}</td>
                                                        <td>{{ $booking->booking_code }}</td>
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
                                                                <span
                                                                    class="badge rounded-0 text-bg-danger">Cancelled</span>
                                                            @endif
                                                        </td>
                                                        <td class="action">
                                                            @if ($booking->status == '0' || $booking->status == '1')
                                                                <div class="dropdown hide-dd">
                                                                    <button
                                                                        class="btn btn-outline-secondary rounded-0 dropdown-toggle"
                                                                        type="button" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                        Action
                                                                    </button>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                                data-bs-target="#voucher{{ $key }}">View</a>
                                                                        </li>
                                                                        <li>
                                                                            <hr class="dropdown-divider">
                                                                        </li>
                                                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                                data-bs-target="#exampleModal{{ $key }}">Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <hr class="dropdown-divider">
                                                                        </li>
                                                                        <li><a class="dropdown-item cancel-btn"
                                                                                href="{{ route('bookCancel', $booking->id) }}">Cancel</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                <div class="modal fade rounded-0" id="voucher{{$key}}"
                                                                    tabindex="-1" aria-labelledby="voucher-modal"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content rounded-0">
                                                                            <div class="modal-header">
                                                                                <h1 class="modal-title fs-5"
                                                                                    id="voucher-modal">Booking Voucher</h1>
                                                                                <button type="button"
                                                                                    class="btn-close rounded-0"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="ms-2">
                                                                                    <span class=" fw-bolder me-3">Booking ID:</span>
                                                                                    <span>{{ $booking->booking_code }}</span>
                                                                                </div>
                                                                                <div class="ms-2">
                                                                                    <span class=" fw-bolder me-3">Date:</span>
                                                                                    <span>{{ $booking->created_at }}</span>
                                                                                </div>
                                                                                <table class="table">
                                                                                    <thead>
                                                                                        <th>Package Name</th>
                                                                                        <th>People</th>
                                                                                        <th>Price</th>
                                                                                        <th>Amount</th>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>{{ $booking->package->name }}</td>
                                                                                            <td>{{ $booking->quantity }}</td>
                                                                                            <td>{{ $booking->package->price }}</td>
                                                                                            <td>{{ $booking->amount }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="3">
                                                                                                <span class=" fw-bolder">Total</span>
                                                                                            </td>
                                                                                            <td>
                                                                                                <span class=" fw-bolder">{{ $booking->amount }}</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <a href="#" class="btn-custom1">
                                                                                    Download <i class="bi bi-download"></i>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="modal fade rounded-0"
                                                                    id="exampleModal{{ $key }}" tabindex="-1"
                                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                                                <form id="book-form{{ $key }}"
                                                                                    action="{{ route('bookUpdate', $booking->id) }}"
                                                                                    method="POST" class="book">
                                                                                    @csrf
                                                                                    @method('put')
                                                                                    <input type="hidden" name="package_id"
                                                                                        value="{{ $booking->package_id }}">
                                                                                    <div class="mb-3">
                                                                                        <label class="form-label">Number of
                                                                                            People</label>
                                                                                        <input type="number"
                                                                                            name="quantity"
                                                                                            class="form-control"
                                                                                            id="qty"
                                                                                            value="{{ $booking->quantity }}">
                                                                                    </div>
                                                                                    <div class="my-3">
                                                                                        <label class="form-label">Booking
                                                                                            Date</label>
                                                                                        <input type="date"
                                                                                            name="schedule"
                                                                                            class="form-control"
                                                                                            id="schedule"
                                                                                            value="{{ $booking->schedule }}">
                                                                                    </div>
                                                                                    <hr>
                                                                                    <div class="text-end mt-3">
                                                                                        <button
                                                                                            style="border: none!important;"
                                                                                            class="btn-custom1">Update</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <form action="{{ route('bookDelete', $booking->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit"
                                                                        class="del-btn btn btn-danger rounded-0">
                                                                        <i class="bi bi-trash"></i>
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="9" class="text-center">There is no booking.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                        <div class="mt-3 pag">
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
        $(document).ready(function() {
            $('.cancel-btn').on('click', function(e) {
                e.preventDefault()
                Swal.fire({
                    title: 'Are you sure to cancel this booking?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('tr').find('.hide-dd').addClass('d-none')
                        $(this).closest('tr').find('.status').html(
                            `<span class="badge rounded-0 text-bg-danger">Cancelled</span>`)
                        $(this).closest('tr').find('.action').html(`
                        <form action="" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="del-btn btn btn-danger rounded-0">
                            <i class="bi bi-trash"></i>
                        </button>
                        </form>
                        `)
                        let link = $(this).attr('href')
                        $.get(link, function(data) {
                            if (data == 'success') {
                                showToast("Your Booking is cancelled successfully.")
                                location.reload()
                            } else {
                                alert('Something went wrong!')
                            }
                        })
                    }
                })
            })

            $('.del-btn').on('click', function(e) {
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

            // $('.book').on('submit',function(e){
            //     e.preventDefault()
            //     let input = $(this).serialize()
            //     $.post($(this).attr('action'),input, function(data){
            //         $(this).parents('td').siblings('.qt').html(data.quantity)
            //         $(this).parent('td').siblings('.sd').html(data.schedule)
            //         $('.modal').modal('hide')
            //         $(this).children('#qty').val(data.quantity)
            //         $(this).children('#schedule').val(data.schedule)
            //         showToast("Your Booking is updated successfully.")
            //     })
            // })
        })
    </script>
@endpush
