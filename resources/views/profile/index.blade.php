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
                                                                                data-bs-target="#voucher{{ $key }}">
                                                                                <i class="bi bi-file-earmark text-info"></i>
                                                                                View</a>
                                                                        </li>
                                                                        <li>
                                                                            <hr class="dropdown-divider">
                                                                        </li>
                                                                        <li><a href="{{ route('bookingShow',$booking->id) }}" class="dropdown-item edit-btn" data-link="{{ route('bookUpdate',$booking->id) }}">
                                                                                <i
                                                                                    class="bi bi-pencil-square text-warning "></i>
                                                                                Edit</a>
                                                                        </li>
                                                                        <li>
                                                                            <hr class="dropdown-divider">
                                                                        </li>
                                                                        <li><a class="dropdown-item cancel-btn"
                                                                                href="{{ route('bookCancel', $booking->id) }}">
                                                                                <i class="bi bi-x-square text-danger"></i>
                                                                                Cancel</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>

                                                                <div class="modal fade rounded-0"
                                                                    id="voucher{{ $key }}" tabindex="-1"
                                                                    aria-labelledby="voucher-modal" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content rounded-0 w-auto">
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
                                                                                    <span class=" fw-bolder me-3">Booking
                                                                                        ID:</span>
                                                                                    <span>{{ $booking->booking_code }}</span>
                                                                                </div>
                                                                                <div class="ms-2">
                                                                                    <span
                                                                                        class=" fw-bolder me-3">DateTime:</span>
                                                                                    <span>{{ $booking->created_at }}</span>
                                                                                </div>
                                                                                <div class="ms-2">
                                                                                    <span
                                                                                        class=" fw-bolder me-3">Destination
                                                                                        Place:</span>
                                                                                    <span>{{ $booking->place->name }}</span>
                                                                                </div>
                                                                                <div class="ms-2">
                                                                                    <span
                                                                                        class=" fw-bolder me-3">Vehicle:</span>
                                                                                    <span
                                                                                        class="vehicle-model">{{ $booking->vehicle->model }}</span>
                                                                                </div>
                                                                                <div class="ms-2">
                                                                                    <span
                                                                                        class=" fw-bolder me-3">UserName:</span>
                                                                                    <span>{{ Auth::user()->name }}</span>
                                                                                </div>
                                                                                <table class="table">
                                                                                    <thead>
                                                                                        <th>Package Name</th>
                                                                                        <th>Schedule</th>
                                                                                        <th>People</th>
                                                                                        <th>Price</th>
                                                                                        <th>Vehicle's Price</th>
                                                                                        <th>Amount</th>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        <tr>
                                                                                            <td>{{ $booking->package->name }}
                                                                                            </td>
                                                                                            <td class="text-nowrap">
                                                                                                {{ $booking->schedule }}
                                                                                            </td>
                                                                                            <td>{{ $booking->quantity }}
                                                                                            </td>
                                                                                            <td>{{ $booking->package->price }}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{ $booking->vehicle->price }}
                                                                                            </td>
                                                                                            <td>{{ $booking->amount }}</td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <td colspan="5">
                                                                                                <span
                                                                                                    class=" fw-bolder">Total</span>
                                                                                            </td>
                                                                                            <td>
                                                                                                <span
                                                                                                    class=" fw-bolder">{{ $booking->amount }}</span>
                                                                                            </td>
                                                                                        </tr>
                                                                                    </tbody>
                                                                                </table>
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
                    <div class="modal fade rounded-0" id="update-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-0">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Book Now</h1>
                                    <button type="button" class="btn-close rounded-0" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="update-book-form" action="" method="POST" class="book">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="package_id" id="package">
                                        <div class="mb-3">
                                            <label class="form-label">Number of
                                                People</label>
                                            <input type="number" name="quantity" class="form-control" id="qty">
                                        </div>
                                        <div class="my-3">
                                            <label class="form-label">Booking
                                                Date</label>
                                            <input type="date" min="{{ now()->format('Y-m-d') }}" name="schedule"
                                                class="form-control" id="schedule">
                                        </div>
                                        <div class="mt-3">
                                            <label class="form-label">Where
                                                should we pick you up?</label>
                                            <select name="place_id" class="form-control" id="place">
                                                @forelse ($places as $place)
                                                    <option value="{{ $place->id }}" class="text-capitalize">
                                                        {{ $place->name }}
                                                    </option>
                                                @empty
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="my-3 col-6">
                                                <label class="form-label">Choose a
                                                    vehicle</label>
                                                <select name="vehicle_id" class="form-control"
                                                    id="vehicle" required>
                                                    <option disabled selected>
                                                        Choose a vehicle
                                                    </option>
                                                    @forelse ($vehicles as $vehicle)
                                                        @if ($vehicle->status == 1)
                                                            <option data-price="{{ $vehicle->price }}"
                                                                data-seat="{{ $vehicle->seat }}"
                                                                value="{{ $vehicle->id }}" class="text-capitalize">
                                                                {{ $vehicle->model }}
                                                                ({{ $vehicle->seat }}
                                                                seats)
                                                            </option>
                                                        @endif
                                                    @empty
                                                        <option class="text-capitalize">
                                                            Not Avaliable
                                                        </option>
                                                    @endforelse
                                                </select>

                                            </div>
                                            <div class="my-3 col-6">
                                                <label class="form-label">Vehicle's
                                                    Price</label>
                                                <input type="number" disabled class="form-control v-price"
                                                    value="">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="text-end mt-3">
                                            <button style="border: none!important;" class="btn-custom1" type="submit">Update</button>
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

            //function for selected value
            $('#vehicle').on('change',function () {
                var i = $('#vehicle option:selected').attr('data-price');
                $('.v-price').val(i)
            })

            //function for seat 
            function filtering(){
                let seatNo = $('#qty').val()
                if(seatNo > Number($('#vehicle option:selected').attr('data-seat'))){
                    $('#vehicle').val('')
                    $('.v-price').val('')
                }
                $('#vehicle > option').each(function(a) {
                    if (seatNo > Number($(this).attr('data-seat'))) {
                        $(this).attr('hidden', 'hidden')
                    } else {
                        $(this).removeAttr('hidden')
                    }
                });
            }
            $('#qty').on('change',function () {
                filtering()
            })

            $('.edit-btn').on('click',function(e){
                e.preventDefault()
                let dataLink = $(this).attr('data-link')
                $.get($(this).attr('href'),function(data){
                    console.log(data.place_id)
                    $('#qty').val(data.quantity)
                    $('#update-modal').modal('show')
                    filtering()
                    $('#package').val(data.package_id)
                    $('#schedule').val(data.schedule)
                    $('.v-price').val(data.vehicle.price)
                    $('#place').val(data.place_id)
                    $('#vehicle').val(data.vehicle_id)
                    $('#update-book-form').attr('action',dataLink)
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
